<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
    }

    public function index() 
    {
		$this->checkPermission('S13_REPORT');
		$this->checkPermission('S14_REPORT');
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'รายงานแยกตามวาระ';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'รายงานแยกตามวาระ','link'=>base_url('report')),
		);

		$this->load->model('ModelRecruiting');
		$recruitings = $this->ModelRecruiting->getLists();
		$data['recruitings'] = array();
		if (count($recruitings)>0) {
			$i=1;
			foreach ($recruitings as $recruiting) {
				$list = array();
				if ($recruiting->recruiting_type=='committee') {
					$name = 'สรรหาคณะกรรมการดำเนินการ';
					$lists_committee = $this->ModelRecruiting->getRecruitingCommittee($recruiting->id);
					foreach ($lists_committee as $list_committee) {
						$list[] = $list_committee->committee_name;
					}
				} 
				else if ($recruiting->recruiting_type=='members') {
					$name = 'สรรหาผู้แทนสมาชิก';
					$lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting->id);
					foreach ($lists_members as $list_member) {
						$list[] = $list_member->member_group_name;
					}
				}
				$data['recruitings'][] = array(
					'type' => $recruiting->recruiting_type,
					'i'    => $i,
					'id'   => $recruiting->id,
					'name' => $name,
					'list' => implode(', ', $list),
					'set'  => $recruiting->set,
					'year' => $recruiting->year,
					'no'   => $recruiting->no
				);
			}
		}

		$data['region'] = array();
		$this->load->model('ModelRegion');
		$data['region'] = $this->ModelRegion->getLists();


		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('report/index', $data); 
		$this->load->view('common/footer', $data);
	}
	
	public function realtime() {
		$this->checkPermission('S13_REPORT');
		$this->checkPermission('S14_REPORT');
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'รายงานแสดงจำนวนผู้มาใช้สิทธิแยกตามกลุ่มของแต่ละวาระ';
		$data['breadcrumbs'] = array(
			array('name'=>'รายงานแยกตามวาระ','link'=>base_url('report')),
			array('name'=>'รายงานแสดงจำนวนผู้มาใช้สิทธิแยกตามกลุ่มของแต่ละวาระ','link'=>base_url('report/realtime'))
		);

		$data['recruitings'] = array();

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('report/index', $data); 
		$this->load->view('common/footer', $data);
	}

    public function ajaxMember($recruiting_id)
    {
    	$data = array();

    	$this->load->model('ModelMember');
    	$this->load->model('ModelCommittee');
    	$this->load->model('ModelScore');
    	$this->load->model('ModelRecruiting');

    	$recruiting_info = $this->ModelRecruiting->getList($recruiting_id);
    	if ($recruiting_info->recruiting_type=='committee') {
    		$recruiting = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
    		$data['member_groups'] = array();
    		$members = $this->ModelCommittee->getLists();
    		foreach ($members as $member) {
    			if ($member->id == $recruiting[0]->committee_id) {
					// $filter = array('member.member_group_id'=>$member->member_group_id);
					$memberall = $this->ModelMember->getLists();

					
					$filter = array('recruiting_id'=>$recruiting_id);
					$memberuse = $this->ModelScore->countMembergroup2($member->id, $filter);
					$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

					
					$filter = array('recruiting_id'=>$recruiting_id);
					$voteno = $this->ModelScore->countNoVote2($member->id, $filter);
					$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;

					$data['member_groups'][] = array(
						'name'           => $member->name,
						'all'            => number_format(count($memberall),0),
						'memberuse'      => number_format($memberuse,0),
						'membernotuse'   => number_format((count($memberall)-$memberuse),0),
						'percent'        => number_format($percent,2).'%',
						'voteno'         => number_format($voteno,0),
						'percent_voteno' => number_format($percent_voteno,2).'%',
					);
    			}
    		}
    	} else {
	    	$recruiting = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);

			$data['member_groups'] = array();
			$members = $this->ModelMember->getGroups();
			foreach ($members as $member) {

				// only this group recuriting
				if ($member->id == $recruiting[0]->member_group_id) {
					$filter = array('member.member_group_id'=>$member->id);
					$memberall = $this->ModelMember->getLists($filter);

					$filter = array('recruiting_id'=>$recruiting_id);
					$memberuse = $this->ModelScore->countMembergroup($member->id, $filter);
					$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

					$filter = array('recruiting_id'=>$recruiting_id);
					$voteno = $this->ModelScore->countNoVote($member->id, $filter);
					$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;

					$data['member_groups'][] = array(
						'name'           => $member->name,
						'all'            => number_format(count($memberall),0),
						'memberuse'      => number_format($memberuse,0),
						'membernotuse'   => number_format((count($memberall)-$memberuse),0),
						'percent'        => number_format($percent,2).'%',
						'voteno'         => number_format($voteno,0),
						'percent_voteno' => number_format($percent_voteno,2).'%',
					);
				}
			}
    	}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function ajaxColumnChart($recruiting_id)
    {

    	$this->load->model('ModelMember');
    	$this->load->model('ModelScore');
    	$this->load->model('ModelRecruiting');

    	$recruiting = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);

		$data = array();
		$data[] = array(
			'จังหวัด',
			// 'คะแนน'
			'จำนวนผู้มาลงคะแนน',
			'จำนวนผู้ไม่ออกเสียง',
			'จำนวนผู้ไม่มาลงคะแนน'
		);
		$post = $this->input->post();
		$members = $this->ModelMember->getGroups();
		foreach ($members as $member) {

			// only this group recuriting
			if ($member->id == $recruiting[0]->member_group_id) {
				$post['region_id'] = $member->region_id;

				$filter = array('member_group_id'=>$member->id);
				if (isset($post['region_id'])&&$post['region_id']>0) {
					$filter['region.id'] = $post['region_id'];
				}
				if (isset($post['member_group_id'])&&$post['member_group_id']>0) {
					$filter['member.member_group_id'] = $post['member_group_id'];
				}
				$memberall = $this->ModelMember->getLists($filter);

				$vote=0;
				$voteno=0;
				$nocome=0;
				

				$filter = array('recruiting_id'=>$recruiting_id);
				$vote = $this->ModelScore->countMembergroup($member->id, $filter);
				$filter = array('recruiting_id'=>$recruiting_id);
				$voteno = $this->ModelScore->countNoVote($member->id, $filter);
				$nocome = count($memberall)==0 ? 0 : (count($memberall)-(int)$vote);

				if (
					!isset($post['region_id']) ||
					(isset($post['member_group_id'])&&$post['member_group_id']==$member->id) ||
					(isset($post['region_id'])&&$post['region_id']==$member->region_id)
				) {
					
					$data[] = array(
						$member->name,
						(int)$vote,
						(int)$voteno,
						(int)$nocome 
					);
					// $data[] = array('จำนวนผู้มาลงคะแนน', (int)$vote); 
					// $data[] = array('จำนวนผู้ไม่ออกเสียง', (int)$voteno);
					// $data[] = array('จำนวนผู้ไม่มาลงคะแนน', (int)$nocome);
				}

				$vote=0;
				$voteno=0;
				$nocome=0;
			}
		}

		// $data['recruiting_id'] = $recruiting_id;

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }


    public function ajaxPieChart($recruiting_id)
    {

    	$this->load->model('ModelMember');
    	$this->load->model('ModelScore');
    	$this->load->model('ModelRecruiting');

    	$recruiting = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);

		$data = array();
		$data[] = array(
			'รายการ',
			'จำนวน',
		);
		$post = $this->input->post();
		$members = $this->ModelMember->getGroups();
		$num_vote = 0;
		$num_voteno = 0;
		$num_nocome = 0;
		foreach ($members as $member) {

			// only this group recuriting
			if ($member->id == $recruiting[0]->member_group_id) {
				$post['region_id'] = $member->region_id;
				
				$filter = array('member_group_id'=>$member->id);
				if (isset($post['region_id'])&&$post['region_id']>0) {
					$filter['region.id'] = $post['region_id'];
				}
				if (isset($post['member_group_id'])&&$post['member_group_id']>0) {
					$filter['member.member_group_id'] = $post['member_group_id'];
				}
				$memberall = $this->ModelMember->getLists($filter);

				$filter = array('recruiting_id'=>$recruiting_id);
				$vote = $this->ModelScore->countMembergroup($member->id, $filter);

					$filter = array('recruiting_id'=>$recruiting_id);
				$voteno = $this->ModelScore->countNoVote($member->id, $filter);
				$nocome = count($memberall)-(int)$vote;


				if (
					!isset($post['region_id']) ||
					(isset($post['region_id'])&&$post['region_id']==$member->region_id) || 
					(isset($post['member_group_id'])&&$post['member_group_id']==$member->id)
				) {
					$num_vote += (int)$vote;
					$num_voteno += (int)$voteno;
					$num_nocome += $nocome;
					
				}
			}
		}
		$data[] = array(
			'จำนวนผู้มาลงคะแนน',
			(int)$num_vote,
		);
		$data[] = array(
			'จำนวนผู้ไม่ออกเสียง',
			(int)$num_voteno,
		);
		$data[] = array(
			'จำนวนผู้ไม่มาลงคะแนน',
			(int)$num_nocome 
		);

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }

    public function ajaxFindMemberGroup()
    {
    	$data = array();
    	$this->load->model('ModelMember');
    	$filter['region_id'] = $this->input->post('region_id');
		$data = $this->ModelMember->getGroups($filter);

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }

    public function date()
    {
    	$this->checkPermission('S13_REPORT');
		$this->checkPermission('S15_REPORT');

    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'รายงานแยกตามวันที่';
		$data['breadcrumbs'] = array(
			array('name'=>'รายงานแยกตามวันที่','link'=>base_url('report/date')),
		);

    	$this->load->model('ModelMember');
    	$this->load->model('ModelScore');

		$data['member_groups'] = array();
		$data['date'] = '';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$members = $this->ModelMember->getGroups();
			$fixdate = strtotime('2020-10-15 00:00:00');
			foreach ($members as $member) {
				$filter = array('member.member_group_id'=>$member->id);
				$memberall = $this->ModelMember->getLists($filter);

				$temp = explode('-', $this->input->post('date'));
				$date = $temp[2].'-'.$temp[1].'-'.$temp[0];


				$filter = array('date_start'=>$date.' 00:00:00', 'date_end'=>$date.' 23:59:59');
				$memberuse = $this->ModelScore->countMembergroup($member->id, $filter);
				$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

				$filter = array('date'=>$date);
				$voteno = $this->ModelScore->countNoVote($member->id, $filter);
				$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;

				$data['member_groups'][] = array(
					'name'           => $member->name,
					'all'            => count($memberall),
					'memberuse'      => $memberuse,
					'membernotuse'   => (count($memberall)-$memberuse),
					'percent'        => number_format($percent,2).'%',
					'voteno'         => number_format($voteno,0),
					'percent_voteno' => number_format($percent_voteno,2).'%',
				);
			}

			$data['date'] = $this->input->post('date');
		}

		$data['action'] = base_url('Report/Date');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('report/date', $data); 
		$this->load->view('common/footer', $data);
    }

    public function type() 
    {
    	$this->checkPermission('S13_REPORT');
		$this->checkPermission('S15_REPORT');

    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'รายงานแยกตามประเภท';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'รายงานแยกตามประเภท','link'=>base_url('report/type')),
		);

		$this->load->model('ModelMember');
		$this->load->model('ModelRegion');
		$this->load->model('ModelRecruiting');
    	$this->load->model('ModelScore');

		$regions = $this->ModelRegion->getLists();
		$groups = array();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$groups_info = $this->ModelMember->getGroups($filter);	
			$groups[$region->name] = $groups_info;
		}

		$data['recruitings'] = array();
		$data['member_group_id'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['member_group_id'] = $this->input->post('member_group_id'); 
			$member_group_id = !empty($this->input->post('member_group_id')) ? $this->input->post('member_group_id') : null;
			$recruitings_info = $this->ModelRecruiting->getListsWithMemberGroupId();
			$filter = array('member.member_group_id'=>$member_group_id);
			$memberall = $this->ModelMember->getLists($filter);
			$fixdate = strtotime('2020-10-15 00:00:00');
			foreach ($recruitings_info as $recruiting) {
				if (strtotime($recruiting['date_score_start']) < $fixdate) {
					date_default_timezone_set('Europe/Berlin');
				}
				$filter = array(
					'date_start' => $recruiting['date_score_start'],
					'date_end' => $recruiting['date_score_end'],
					'recruiting_id' => $recruiting['id'] 
				);
				$memberuse = $this->ModelScore->countMembergroup($member_group_id, $filter);
				$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

				$filter = array(
					'date_start' => $recruiting['date_score_start'],
					'date_end' => $recruiting['date_score_end'],
					'recruiting_id' => $recruiting['id']
				);
				$voteno = $this->ModelScore->countNoVote($member_group_id, $filter);
				$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;
				$data['recruitings'][] = array(
					'set'            => $recruiting['set'],
					'year'           => $recruiting['year'],
					'no'             => $recruiting['no'],
					'all'            => number_format(count($memberall),0),
					'memberuse'      => number_format($memberuse,0),
					'membernotuse'   => number_format((count($memberall)-$memberuse),0),
					'percent'        => number_format($percent,2).'%',
					'voteno'         => number_format($voteno,0),
					'percent_voteno' => number_format($percent_voteno,2).'%',
				);
			}
			// $data['recruitings'] = $recruitings_info;
			// echo '<pre>';
			// print_r($recruitings_info);
			// echo '</pre>';
		}
		date_default_timezone_set('Asia/Bangkok');
		// foreach ($recruitings_info as $recruiting) {
		// 	if ($recruiting->recruiting_type=='members') {

		// 		$rmg = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting->id);
		// 		print_r($rmg);

		// 		$filter = array('member_group_id'=>$member->id);
		// 		$memberall = $this->ModelMember->getLists($filter);

		// 		$recruitings[] = array(
		// 			'info' => $recruiting,
		// 			'score'
		// 		);
		// 	}
		// }
		
		$data['groups'] = $groups;
		$data['action'] = base_url('report/type');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('report/type', $data); 
		$this->load->view('common/footer', $data);
	}
	
	public function time() {
		$this->checkPermission('S13_REPORT');
		$this->checkPermission('S15_REPORT');

    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'รายงานแยกตามเวลา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'รายงานแยกตามประเภท','link'=>base_url('report/type')),
		);

		$this->load->model('ModelMember');
		$this->load->model('ModelRegion');
		$this->load->model('ModelRecruiting');
		$this->load->model('ModelScore');
		$this->load->model('ModelCommittee');
		
		$recruiting_id = 0;
		

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$recruiting_id = $this->input->post('recruiting_id');
			$recruiting_info = $this->ModelRecruiting->getList($recruiting_id);
			
			// $fix = strtotime('2020-10-16 00:00:00');
			$timestamp_start = strtotime($recruiting_info->date_score_start);
			// if ($timestamp_start < $fix) {
			// 	date_default_timezone_set('Europe/Berlin');
			// } else {
			// 	date_default_timezone_set('Asia/Bangkok');
			// }

			$dateScore = date('Y-m-d', $timestamp_start);

			$timeStart = 0;
			$timeEnd = 23;

			$data['result'] = array();

			$groups = $this->ModelMember->getGroups();
			foreach ($groups as $group) {
				$result = array(
					'group' => $group->name,
					'times' => array()
				);
				$times = array();
				for ($i=$timeStart; $i<=$timeEnd; $i++) {
					$hour = sprintf('%02d',$i);
					$start = "$dateScore $hour:00:00";
					$end = "$dateScore $hour:59:59";
					$count = $this->ModelScore->countTimeScore($recruiting_id, $group->id, $start, $end);
					$times[$i] = $count;
				}
				$result['times'] = $times;
				$data['result'][] = $result;
			}
			
		}

		$data['recruiting_id'] = $recruiting_id;

		$data['recruitings'] = array();
		$recruitings = $this->ModelRecruiting->getLists();
		if (count($recruitings)>0) {
			foreach ($recruitings as $recruiting) {
				$data['recruitings'][] = array(
					'type' => $recruiting->recruiting_type,
					'name' => $recruiting->recruiting_type=='committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก',
					'id'   => $recruiting->id,
					'set'  => $recruiting->set,
					'year' => $recruiting->year,
					'no'   => $recruiting->no
				);
			}
		}
		$data['committee'] = $this->ModelCommittee->getLists();
		
		$data['action'] = base_url('report/time');
		$data['date'] = $this->input->get('date');

		date_default_timezone_set('Asia/Bangkok');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('report/time', $data); 
		$this->load->view('common/footer', $data);
	}

    public function reportScoreWithRangTime()
    {
    	$this->load->model('ModelScore');
    	$results = $this->ModelScore->exportScoreWithRangeTime();

		require_once $this->config->item('base_document').'/assets/PHPExcel-1.8/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("MunkGorn")
		                     ->setLastModifiedBy("MunkGorn")
		                     ->setTitle("Report")
		                     ->setSubject("Report")
		                     ->setDescription("")
		                     ->setKeywords("")
		                     ->setCategory("");

		$objPHPExcel->setActiveSheetIndex(0);
		//$objPHPExcel->setTitle('Report');

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ช่วงเวลา');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'ภาค');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'กลุ่ม');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'จำนวนคนมาลงคะแนน');

        $i=2;
        foreach ($results as $time => $result) {
        	foreach ($result as $value) {
		        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $time);
		        $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $value->region_name);
		        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $value->member_group_name);
		        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format($value->vote,2));
	        $i++;
        	}

        }

		$objPHPExcel->getSecurity()->setLockWindows(false);
		$objPHPExcel->getSecurity()->setLockStructure(false);
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$filename = 'Export_REPORT_'.date('My', time()).'.xlsx';
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		$objWriter->save('php://output');

    }

    public function exportExcel($recruiting_id) 
    {
		set_time_limit(0);
		ob_start();
		try {
			require_once $this->config->item('base_document').'/assets/PHPExcel-1.8/Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("MunkGorn")
								->setLastModifiedBy("MunkGorn")
								->setTitle("Report")
								->setSubject("Report")
								->setDescription("")
								->setKeywords("")
								->setCategory("");

			$objPHPExcel->setActiveSheetIndex(0);
			// $objPHPExcel->setTitle('Report');

			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'กลุ่มเขต');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'จำนวนผู้มีสิทธิทั้งหมด');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'จำนวนผู้มาลงคะแนน');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'จำนวนผู้ไม่มาลงคะแนน');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'จำนวนผู้ไม่ออกเสียง');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'จำนวนผู้ไม่ออกเสียง คิดเป็นร้อยละ');

			// $sql = "SELECT * FROM koob_history_import WHERE id > 0 AND date_save LIKE '2019-10-11%' AND store_id = 1 ";
			// $sql .= "ORDER BY ref_id, item_name, quantity, shipping_method, id ASC;";
			// $query = mysqli_query($con, $sql);
			$this->load->model('ModelRecruiting');
			$this->load->model('ModelMember');
			$this->load->model('ModelScore');
			$this->load->model('ModelCommittee');
			// echo '<pre>';
			// print_r($recruiting);
			// echo '</pre>';
			// exit();$this->load->model('ModelCommittee');

			$recruiting_info = $this->ModelRecruiting->getList($recruiting_id);

			if ($recruiting_info->recruiting_type=='committee') {

			
					
				$recruiting = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
				$data['member_groups'] = array();
				$committees = $this->ModelCommittee->getLists();
				$i=2;
				$filter = array();
				foreach ($committees as $committee) {
					if ($committee->id == $recruiting[0]->committee_id) {
						// $filter = array('member.member_group_id'=>$committee->id);
						$memberall = $this->ModelMember->getLists();

						$filter = array('recruiting_id'=>$recruiting_id);
						$memberuse = $this->ModelScore->countMembergroup2($committee->id, $filter);
						$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

						$filter = array('recruiting_id'=>$recruiting_id);
						$voteno = $this->ModelScore->countNoVote2($committee->id, $filter);
						$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;

						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $committee->name);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(count($memberall),0));
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($memberuse,0));
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format((count($memberall)-$memberuse),0));
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, number_format($percent,2).'%');
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, number_format($voteno,0));
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, number_format($percent_voteno,2).'%');

						$i++;
					}
				}
				$objPHPExcel->getActiveSheet()->setTitle('Report');

				$i=2;
				$j=1;
				$objPHPExcel->createSheet(1);
				$scores = $this->ModelScore->getListsVote($recruiting_id);
				$membervote = array();
				$objPHPExcel->setActiveSheetIndex(1);
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ลำดับที่');
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'เลขสมาชิก');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ชื่อ');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'สกุล');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขบัตรประจำตัวประชาชน');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'รหัสกลุ่ม');
				foreach ($scores as $score) {
					$membervote[] = $score->member_id;
					$member = $this->ModelMember->getList($score->member_id);
					$textvote = 'มาลงคะแนน';	
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $j++);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '="'.$member->member_no.'"');
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $member->prefix_name.' '.$member->firstname);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $member->lastname);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '="'.$member->id_card.'"');
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, '="'.$member->temp_member_group_code.'"');
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $textvote);
					$i++;
				}
				$objPHPExcel->getActiveSheet()->setTitle('Member Vote');



				$i=2;
				$j=1;
				$objPHPExcel->createSheet(2);
				// $members = $this->ModelMember->getListsWithScore($recruiting_id);
				$members = $this->ModelMember->getLists();
				$objPHPExcel->setActiveSheetIndex(2);
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ลำดับที่');
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'เลขสมาชิก');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ชื่อ');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'สกุล');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'เลขบัตรประจำตัวประชาชน');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'รหัสกลุ่ม');
				// $objPHPExcel->getActiveSheet()->setCellValue('G1', '');
				foreach ($members as $member) {
					if (!in_array($member->id, $membervote)) {
						$textvote = 'ไม่มาลงคะแนน';
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $j++);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '="'.$member->member_no.'"');
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $member->prefix_name.' '.$member->firstname);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $member->lastname);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, '="'.$member->id_card.'"');
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, '="'.$member->temp_member_group_code.'"');
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $textvote);
						$i++;
					}
				}
				$objPHPExcel->getActiveSheet()->setTitle('Member Novote');
			} else {

				$recruiting = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
				$data['member_groups'] = array();
				$members = $this->ModelMember->getGroups();
				$i=2;
				foreach ($members as $member) {
					// only this group recuriting
					if ($member->id == $recruiting[0]->member_group_id) {
						$filter = array('member.member_group_id'=>$member->id);
						$memberall = $this->ModelMember->getLists($filter);

						$filter = array('recruiting_id'=>$recruiting_id);
						$memberuse = $this->ModelScore->countMembergroup($member->id, $filter);
						$percent = (count($memberall)>0) ? ( ((double)$memberuse/count($memberall)) * 100) : 0;

						$filter = array('recruiting_id'=>$recruiting_id);
						$voteno = $this->ModelScore->countNoVote($member->id, $filter);
						$percent_voteno = (count($memberall)>0) ? ( ((double)$voteno/count($memberall)) * 100) : 0;

						$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $member->name);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, number_format(count($memberall),0));
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, number_format($memberuse,0));
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, number_format((count($memberall)-$memberuse),0));
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, number_format($percent,2).'%');
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, number_format($voteno,0));
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, number_format($percent_voteno,2).'%');

						$i++;
					}
				}
				$objPHPExcel->getActiveSheet()->setTitle('Report');
			}

			
			$objPHPExcel->getSecurity()->setLockWindows(false);
			$objPHPExcel->getSecurity()->setLockStructure(false);
			$objPHPExcel->setActiveSheetIndex(0);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$filename = 'Export_'.date('My', time()).'.xlsx';
			// header('Content-type: application/vnd.ms-excel');
			// header('Content-Disposition: attachment;filename="' . $filename . '"');
			// header('Cache-Control: max-age=0');

			// unlink($this->config->item('base_document').'uploads/export/'.$filename);
			$objWriter->save($this->config->item('base_document') . 'uploads/export/' . $filename);
			// redirect('');
			echo '<script>';
			echo 'window.location.href = "'.$this->config->item('base_url').'uploads/export/'.$filename.'";';
			echo '</script>';
			exit();
			// $objWriter->save('php://output');
		} catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
    }
    
	public function checkLogin() 
	{
		if ($this->session->has_userdata('token')) {
			$this->load->model('ModelMember');
			$token = $this->session->userdata('token');
			$json = json_decode(base64_decode($token));
			$this->ModelMember->id = $json->id;
			$this->ModelMember->id_card = $json->id_card;
			$this->ModelMember->member_no = $json->member_no;
			$this->ModelMember->password = $json->password;
			$result = $this->ModelMember->checkLogin();
			if ($this->ModelMember->checkLogin() != 1) {
				redirect('member/logout');
			}
		} else {
			redirect('member/logout');
		}
	}

	public function checkPermission($permission)
	{
		if ($this->session->has_userdata('token')) {
			$this->load->model('ModelPermission');
			$token = $this->session->userdata('token');
			$json = json_decode(base64_decode($token));
			$permission_info = $this->ModelPermission->getPermission($permission);
			$result = $this->ModelPermission->checkPermission($json->member_type_id, $permission_info->id);
			if ($this->ModelPermission->checkPermission($json->member_type_id, $permission_info->id) != 1) {
				redirect('permission/Noaccess');
			}
		} else {
			redirect('member/logout');
		}
	}

}
?>