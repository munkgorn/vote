<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {

	private $error = array();

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
    }

    public function all() 
    {
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ข้อมูลผู้สมัคร';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ข้อมูลผู้สมัคร','link'=>base_url('Candidate/all')),
		);

		$this->load->model('ModelRecruiting');
		$years = $this->ModelRecruiting->getListsGroupByYear();
		$data['years'] = array();
		if (count($years)>0) {
			foreach ($years as $year) {
				$data['years'][] = $year->year;
			}
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/index', $data); 
		$this->load->view('common/footer', $data);
    }

    public function result($postrecuritingid='', $posttypeid='', $postyear='', $postset='') 
    {


    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ตรวจสอบผลการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ตรวจสอบผลการสรรหา','link'=>base_url('Candidate/result')),
		);

		$this->load->model('ModelRecruiting');
		$years = $this->ModelRecruiting->getListsGroupByYear();
		$data['years'] = array();
		if (count($years)>0) {
			foreach ($years as $value) {
				$data['years'][] = $value->year; 
			}
		}


		if (!empty($postrecuritingid)) {
			$data['recruitingid'] = $postrecuritingid;
		} else {
			$data['recruitingid'] = '';
		}
		if (!empty($posttypeid)) {
			$data['typeid'] = $posttypeid;
		} else {
			$data['typeid'] = '';
		}
		if (!empty($postyear)) {
			$data['year'] = $postyear;
		} else {
			$data['year'] = '';
		}
		if (!empty($postset)) {
			$data['set'] = $postset;
		} else {
			$data['set'] = '';
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/result', $data); 
		$this->load->view('common/footer', $data);
    }



    public function exportPrint($recruiting_id, $type_id) 
    {
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'พิมพ์';
    	$this->load->model('ModelCandidate');
		$this->load->model('ModelRecruiting');
		$this->load->model('ModelMember');
		$this->load->model('ModelCommittee');

		$data['recruiting'] = $this->ModelRecruiting->getList($recruiting_id);

		$type_info = $this->ModelCommittee->getList($type_id);
		// var_dump($data['recruiting']);
		$data['text'] = $data['recruiting']->recruiting_type=='committee' ? 'ผลการนับคะแนนการสรรหา'.$type_info->name.'ระบบออนไลน์' : 'ผลการนับคะแนนการสรรหาผู้แทนสมาชิกระบบออนไลน์';
		$data['text2'] = $data['recruiting']->recruiting_type=='committee' ? 'ควบคุมการลงคะแนนสรรหาระบบออนไลน์' : 'ควบคุมการลงคะแนนสรรหาผู้แทนสมาชิกระบบออนไลน์';


		// if ($data['recruiting']=='committee') {

		// } else {
		// 	$data['member'] = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
		// }


		$month = array(1=>'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');

		$data['month'] = date('d', strtotime($data['recruiting']->date_score_end)).' '.$month[date('n', strtotime($data['recruiting']->date_score_end))].' '.date('Y', strtotime($data['recruiting']->date_score_end));

		$data['candidates'] = array();
		$filter = array('order_score'=>'desc');
		$lists = $this->ModelCandidate->getLists($recruiting_id, $type_id, $filter);
		foreach ($lists as $key => $value) {
			$type_info = $this->ModelRecruiting->findType($value->id);
			$member_info = $this->ModelMember->getList($value->member_id);
			$data['candidates'][] = array(
				'candidate_no'      => $value->candidate_no,
				'recruiting_id'     => $recruiting_id,
				'id'                => $value->id,
				'member_id'         => $value->member_id,
				'member_group_name' => $member_info->member_group_name,
				'type_name'         => $type_info->type_name,
				'name'              => $value->member_prefix . ' ' . $value->firstname . ' ' . $value->lastname,
				'member_no'         => $value->member_no,
				'score'             => !empty($value->score) ? $value->score : 0,
				'receiving'         => $type_info->receiving,
				'reserve'           => $type_info->reserve,
				'type_id'           => $value->type_id,
			);
		}


		$data['page'] = ceil(count($data['candidates'])/10);
		// $data['page'] = 2;
		$this->load->view('common/header', $data);
		$this->load->view('candidate/print', $data); 
		$this->load->view('common/footer', $data);
    }

    public function manageoutcome() 
    {

    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'จัดการผลการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการผลการสรรหา','link'=>base_url('Candidate/manageoutcome')),
		);


		$this->load->model('ModelRecruiting');
		$years = $this->ModelRecruiting->getListsGroupByYear();
		$data['years'] = array();
		if (count($years)>0) {
			foreach ($years as $year) {
				$data['years'][] = $year->year;
			}
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/manageoutcome', $data); 
		$this->load->view('common/footer', $data);
    }

    public function vote() 
    {
    	$this->checkLogin();
    	$this->checkPermission('S08_VOTE');
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ลงคะแนน';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ลงคะแนน','link'=>base_url('Candidate/vote')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelScore');
		$this->load->model('ModelCandidate');
		$recruitings = $this->ModelRecruiting->getLists();

		$token = $this->session->userdata('token');
		$member = json_decode(base64_decode($token));
		$data['recruitings'] = array();
		if (count($recruitings)>0) {
			$i=1;
			foreach ($recruitings as $key => $value) {
				$list = array();
				$list2 = array();
				if ($value->recruiting_type=='committee') {
					// $bypass_committee = true;
					$lists_committee = $this->ModelRecruiting->getRecruitingCommittee($value->id);
					foreach ($lists_committee as $list_committee) {
						$list2[] = $list_committee->committee_name;
						$list[] = array(
							'name' => $list_committee->committee_name,
							'type_id' => $list_committee->type_id,
						);
					}
				}
				if ($value->recruiting_type=='members') {
					// $bypass_committee = false;
					$lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
					foreach ($lists_members as $list_member) {
						// echo $list_member->type_id;
						if ($member->member_group_id==$list_member->type_id) {
						$list2[] = $list_member->member_group_name;
							$list[] = array(
								'name' => $list_member->member_group_name,
								'type_id' => $list_member->type_id,
							);
						}
					}
				}

				// if ($value->recruiting_type == 'committee') {
				// 	$list = array();
				// 	$temp = $this->ModelRecruiting->getRecruitingCommittee($value->id);
				// 	foreach ($temp as $tmp) {
				// 		$list[] = $tmp->committee_name;
				// 	}
				// }
				
				// if ($value->recruiting_type == 'members') {
				// 	$list = array();
				// 	$temp = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
				// 	foreach ($temp as $tmp) {
				// 		if ($member->member_group_id==$tmp->type_id) {
				// 			$list[] = $tmp->member_group_name;	
				// 		}
				// 	}
				// }

				$status = false;
				$resultScore = $this->ModelScore->findMyScore($value->id, $member->id);
				if ((int)$resultScore>0) {
					$status=true;
				}

				date_default_timezone_set("Asia/Bangkok");

				$outtimevote = false;
				$timevote = false;
				if (time()>=strtotime($value->date_score_start)&&time()<=strtotime($value->date_score_end)) {
					$timevote = true;
				}
				else if (time()>=strtotime($value->date_score_end)) {
					$outtimevote = true;
				}

				$timevote_text = '';
				if ($timevote==false) {
					$timevote_text .=  '<a href="'.base_url().'Candidate/VoteScore/'.$value->id.'" class="btn btn-default btn-sm">ดูรายละเอียด</a><br>';
					$timevote_text .= 'เวลาลงคะแนน<br>'.date('d/m/Y H:i',strtotime($value->date_score_start)).'น.<br>ถึง<br>'.date('d/m/Y H:i',strtotime($value->date_score_end)).'น.';
				}

				$candidate_lists = $this->ModelCandidate->getLists($value->id, $member->member_type_id);

				$candidates = array();
				foreach ($candidate_lists as $value3) {
					$candidates[] = array(
						'name'         => $value3->member_prefix.' '.$value3->firstname.' '.$value3->lastname,
						'image'        => !empty($value3->image) ? base_url().'/uploads/'.$value3->image : '',
						'candidate_id' => $value3->id,
						'member_id'    => $value3->member_id,
						'type' => $value3->type_id,
					);
				}

				
				$check = 0;
				// $check += count($candidates);
				$canvote = true;
				// if ($check==0) {
				// 	$canvote = false;
				// }

				// echo $status;

				// var_dump($canvote);
				// var_dump($timevote);
				// echo '<br>';

				// check i can vote?
				if (count($list)>0) {
					$data['recruitings'][] = array(
						'id'                  => $value->id,
						'sort'                => $value->sort,
						// 'type_id'          => $value->
						'i'                   => $i++,
						'recruiting_type'     => ($value->recruiting_type == 'committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก'),
						'lists'               => count($list2) > 0 ? implode(',', $list2) : '',
						// 'lists'            => json_encode($list),
						'type_id'             => $list[0]['type_id'],
						'set'                 => $value->set,
						'year'                => $value->year,
						'no'                  => $value->no,
						'status'              => $status,
						'timevote'            => $timevote,
						'timevote_text'       => $timevote_text,
						'canvote'             => $canvote,
						'outtimevote'         => $outtimevote,
						// 'bypass_committee' => $bypass_committee
					);
				}
			}
		}

	


		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/vote', $data); 
		$this->load->view('common/footer', $data);	
		
    }

    public function VoteScore($id) 
    {
		$this->checkLogin();
    	$this->checkPermission('S08_VOTE');
    	$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ลงคะแนน';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ลงคะแนน','link'=>base_url('Candidate/VoteScore'.$id)),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCandidate');
		$this->load->model('ModelScore');

		$token = $this->session->userdata('token');
		$member = json_decode(base64_decode($token));

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$post = $this->input->post();
			if (count($post['vote'])>0 && $post['voteno']==0) {
				$insert = array();
				$allempty = true;
				foreach ($post['vote'] as $key => $vote) {
					$v = explode(',', $vote);
					foreach ($v as $k => $value) {
						if (!empty($value)) {
							$insert[] = array(
								'member_id'     => $member->id,
								'recruiting_id' => $id,
								'candidate_id'  => $value,
								'vote'          => 1
							);
						}
					}
				}

				foreach ($insert as $in) {
					$result = $this->ModelScore->add($in);
				}
				$name = $member->prefix_name.' '.$member->firstname.' '.$member->lastname;
				$this->session->set_userdata('success', $name.' ได้ลงคะแนนเรียบร้อยแล้ว');
			} else {
				$this->session->set_userdata('error', 'กรุณาเลือกผู้สมัครเพื่อลงคะแนน');
			}
			if ($post['voteno']==1) {
				$this->session->unset_userdata('error');
				$candidates = $this->ModelCandidate->getLists($id);
				foreach ($candidates as $candidate) {
					$in = array(
						'member_id'     => $member->id,
						'recruiting_id' => $id,
						'candidate_id'  => $candidate->id,
						'vote'          => 0
					);
					$result = $this->ModelScore->add($in);
				}
			}
			// redirect('Candidate/Vote/'.$id);

			$next = $this->checkHasNextVote();
			if ($next==false) {
				redirect('member/logout');
			} else {
				redirect('Candidate/VoteScore/'.$next);
			}
			exit();
		}

		$recruiting = $this->ModelRecruiting->getList($id);
		// if (count($recruitings)>0) {
			// $i=1;
			// foreach ($recruitings as $key => $value) {
				if ($recruiting->recruiting_type == 'committee') {
					$list = array();
					$temp = $this->ModelRecruiting->getRecruitingCommittee($recruiting->id);
					foreach ($temp as $tmp) {
						$lists[] = array(
							'name'      => $tmp->committee_name, 
							'id'        => $tmp->id,
							'type_id'   => $tmp->type_id,
							'receiving' => $tmp->receiving,
						);
					}
				}
				if ($recruiting->recruiting_type == 'members') {
					$list = array();
					$temp = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting->id);
					foreach ($temp as $tmp) {
						if ($member->member_group_id==$tmp->type_id) {
							$lists[] = array(
								'name'      => $tmp->member_group_name, 
								'id'        => $tmp->id,
								'type_id'   => $tmp->member_group_id,
								'receiving' => $tmp->receiving,
							);
						}
					}
				}


				foreach ($lists as $k => $value2) {
					$candidate_lists = $this->ModelCandidate->getLists($recruiting->id, $value2['type_id']);

					$candidates = array();
					foreach ($candidate_lists as $value3) {
						$candidates[] = array(
							'candidate_no' => $value3->candidate_no,
							'name'         => $value3->member_prefix.' '.$value3->firstname.' '.$value3->lastname,
							'image'        => !empty($value3->image) ? base_url().'/uploads/'.$value3->image : '',
							'candidate_id' => $value3->id,
							'member_id'    => $value3->member_id
						);
					}

					$data['lists'][] = array(
						'id'         => $value2['id'],
						'name'       => $value2['name'],
						'max'        => $value2['receiving'],
						'candidates' => $candidates
					);
				}
			// }
		// }


		$check = 0;
		foreach ($data['lists'] as $value) {
			$check += count($value['candidates']);	
		}
		
		$canvote = true;
		if ($check==0) {
			$canvote = false;
		}
		$data['check'] = $check;


		date_default_timezone_set("Asia/Bangkok");

		$timevote = false;
		if (time()>=strtotime($recruiting->date_score_start)&&time()<=strtotime($recruiting->date_score_end)) {
			$timevote = true;
		}

		$data['timevote'] = $timevote==false ? 0 : 1;

		$timevote_text = '';
		if ($timevote==false) {
			$timevote_text = 'เวลาลงคะแนน<br>วันที่ '.date('d-m-Y H:i',strtotime($recruiting->date_score_start)).' ถึง วันที่ '.date('d-m-Y H:i',strtotime($recruiting->date_score_end));
		}

		$data['timevote_text'] = $timevote_text;



		$data['action'] = base_url('candidate/VoteScore/'.$id);

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/votescore', $data); 
		$this->load->view('common/footer', $data);
	}
	
	public function checkHasNextVote() 
	{
		$this->checkLogin();
		$this->checkPermission('S08_VOTE');
		$this->load->model('ModelRecruiting');
		$this->load->model('ModelScore');
		$this->load->model('ModelCandidate');
		$recruitings = $this->ModelRecruiting->getLists();

		$token = $this->session->userdata('token');
		$member = json_decode(base64_decode($token));
		$data['recruitings'] = array();
		if (count($recruitings)>0) {
			$i=1;
			foreach ($recruitings as $key => $value) {
				$list = array();
				$list2 = array();
				if ($value->recruiting_type=='committee') {
					$lists_committee = $this->ModelRecruiting->getRecruitingCommittee($value->id);
					foreach ($lists_committee as $list_committee) {
						$list2[] = $list_committee->committee_name;
						$list[] = array(
							'name' => $list_committee->committee_name,
							'type_id' => $list_committee->type_id,
						);
					}
				}
				if ($value->recruiting_type=='members') {
					// $bypass_committee = false;
					$lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
					foreach ($lists_members as $list_member) {
						if ($member->member_group_id==$list_member->type_id) {
						$list2[] = $list_member->member_group_name;
							$list[] = array(
								'name' => $list_member->member_group_name,
								'type_id' => $list_member->type_id,
							);
						}
					}
				}


				$status = false;
				$resultScore = $this->ModelScore->findMyScore($value->id, $member->id);
				if ((int)$resultScore>0) {
					$status=true;
				}

				date_default_timezone_set("Asia/Bangkok");

				$outtimevote = false;
				$timevote = false;
				if (time()>=strtotime($value->date_score_start)&&time()<=strtotime($value->date_score_end)) {
					$timevote = true;
				}
				else if (time()>=strtotime($value->date_score_end)) {
					$outtimevote = true;
				}

				$timevote_text = '';
				if ($timevote==false) {
					$timevote_text .=  '<a href="'.base_url().'Candidate/VoteScore/'.$value->id.'" class="btn btn-default btn-sm">ดูรายละเอียด</a><br>';
					$timevote_text .= 'เวลาลงคะแนน<br>'.date('d/m/Y H:i',strtotime($value->date_score_start)).'น.<br>ถึง<br>'.date('d/m/Y H:i',strtotime($value->date_score_end)).'น.';
				}

				$candidate_lists = $this->ModelCandidate->getLists($value->id, $member->member_type_id);

				$candidates = array();
				foreach ($candidate_lists as $value3) {
					$candidates[] = array(
						'name'         => $value3->member_prefix.' '.$value3->firstname.' '.$value3->lastname,
						'image'        => !empty($value3->image) ? base_url().'/uploads/'.$value3->image : '',
						'candidate_id' => $value3->id,
						'member_id'    => $value3->member_id,
						'type' => $value3->type_id,
					);
				}

				
				$check = 0;
				$canvote = true;
				// check i can vote?
				if (count($list)>0 && $timevote == 1 && empty($status)) {
					$data['recruitings'][] = array(
						'id'                  => $value->id,
						'sort'                => $value->sort,
						'i'                   => $i++,
						'recruiting_type'     => ($value->recruiting_type == 'committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก'),
						'lists'               => count($list2) > 0 ? implode(',', $list2) : '',
						'type_id'             => $list[0]['type_id'],
						'set'                 => $value->set,
						'year'                => $value->year,
						'no'                  => $value->no,
						'status'              => (bool)$status,
						'timevote'            => $timevote,
						'timevote_text'       => $timevote_text,
						'canvote'             => $canvote,
						'outtimevote'         => $outtimevote,
					);
				}
			}
		}

		if (count($data['recruitings']) > 0) {
			return $data['recruitings'][0]['id'];
		} else {
			return false;
		}

	}


    public function add($recruiting_id) 
    {
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ผู้สมัครรับการสรรหา';
		$data['button_title'] = 'เพิ่มผู้สรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ผู้สมัครรับการสรรหา','link'=>base_url('recruiting')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCandidate');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');

		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			// Upload
			$image = '';

			if ($_FILES['image']['error']==0) {
				ini_set( 'memory_limit', '200M' );
				ini_set('upload_max_filesize', '200M');  
				ini_set('post_max_size', '200M');  
				ini_set('max_input_time', 3600);  
				ini_set('max_execution_time', 3600);

				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '10000';
				$config['max_width']     = '1280';
				$config['max_height']    = '800';
				$config['encrypt_name']  = TRUE;
				
				$this->upload->initialize($config);

				if ( !$this->upload->do_upload('image') ) {
					$this->error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$image = $upload_data['file_name'];
				}
			}
			// Upload

			$token = $this->session->userdata('token');
			$member = json_decode(base64_decode($token));
			$post = $this->input->post();

			unset($post['zero_config_length']);

			$post['image'] = $image;
			// $post['member_id']    = $member->id;
			$post['recruiting_id'] = $recruiting_id;

			if ($this->input->post('date_register')) {
				$temp = explode('-', $this->input->post('date_register'));
				$post['date_register'] = $temp[2].'-'.$temp[1].'-'.$temp[0];
			}
			$candidate_id = $this->ModelCandidate->add($post);

			if ($candidate_id>0) {
				$this->session->set_userdata('success', 'เพิ่มผู้สมัครเรียบร้อยแล้ว');	
			} else {
				$this->session->set_userdata('error', 'ผิดพลาดในการเพิ่มผู้สมัคร');	
			}

			redirect('Candidate/add/'.$recruiting_id);
			exit();
		}

			$data['image']             = '';
			$data['author']            = '';
			$data['date_register']     = '';
			$data['member_id']         = '';
			$data['member_id']         = '';
			$data['member_no']         = '';
			$data['age']               = '';
			$data['position']          = '';
			$data['member_year']       = '';
			$data['member_month']      = '';
			$data['member_group_name'] = '';
			$data['phone_office']      = '';
			$data['phone_office']      = '';
			$data['type_id']           = '';
			$data['phone']             = '';
			$data['candidate_no']      = '';


		$data['recruiting_id'] = $recruiting_id;

		$data['candidates'] = array();
		$candidates = $this->ModelCandidate->getLists($recruiting_id);
		foreach ($candidates as $candidate) {
			$type_info = $this->ModelRecruiting->findType($candidate->id);
			$data['candidates'][] = array(
				'id'           => $candidate->id,
				'type_name'    => $type_info->type_name,
				'candidate_no' => $candidate->candidate_no,
				'name'         => $candidate->member_prefix.' '.$candidate->firstname.' '.$candidate->lastname,
				'member_no'    => $candidate->member_no,
				'status'       => $candidate->status,
				'edit'         => base_url('candidate/edit/'.$recruiting_id.'/'.$candidate->id)
			);
		}
		
		$types = $this->ModelRecruiting->getListsWithType($recruiting_id);
		$data['recruiting_types'] = array();

		if (count($types)>0) {
			foreach ($types as $value) {
				if ($value->recruiting_type=='committee') {
					$data['recruiting_types'][] = array(
						'id' => $value->committee_id,
						'name' => $value->committee_name
					);
				} else if ($value->recruiting_type=='members') {
					$data['recruiting_types'][] = array(
						'id' => $value->member_group_id,
						'name' => $value->member_group_name
					);
				}
			}
		}


		$data['action']              = base_url('candidate/add/'.$recruiting_id);
		$data['action_getcandidate'] = base_url('candidate/getCandidate/'.$recruiting_id);
		$data['action_status']       = base_url('candidate/status/'.$recruiting_id);
		$data['action_del']          = base_url('candidate/delete/'.$recruiting_id);
		
		if ($this->session->has_userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		} else {
			$data['success'] = '';
		}
		if ($this->session->has_userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		} else {
			$data['error'] = '';
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/form', $data); 
		$this->load->view('common/footer', $data);
    }

    public function ajaxAdd() 
    {
    	$data = array();
    	$this->load->model('ModelCandidate');
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
    		$recruiting_id = $this->input->post('recruiting_id');

			// Upload
			$image = '';


			$token = $this->session->userdata('token');
			$member = json_decode(base64_decode($token));
			$post = $this->input->post();

			unset($post['zero_config_length'], $post['recruiting_id']);

			$post['image'] = $image;
			// $post['member_id']    = $member->id;
			$post['recruiting_id'] = $recruiting_id;

			if ($this->input->post('date_register')) {
				$temp = explode('-', $this->input->post('date_register'));
				$post['date_register'] = $temp[2].'-'.$temp[1].'-'.$temp[0];
			}

			$data['post'] = $post;

			$candidate_id = $this->ModelCandidate->add($post);
			$data['result'] = $candidate_id;

			if ($candidate_id>0) {
				$this->session->set_userdata('success', 'เพิ่มผู้สมัครเรียบร้อยแล้ว');	
			} else {
				$this->session->set_userdata('error', 'ผิดพลาดในการเพิ่มผู้สมัคร');	
			}

		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function edit($recruiting_id, $id) 
    {
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ผู้สมัครรับการสรรหา';
		$data['button_title'] = 'แก้ไขผู้สรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ผู้สมัครรับการสรรหา','link'=>base_url('recruiting')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCandidate');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');

		$candidate = $this->ModelCandidate->getList($recruiting_id, $id);
		$member_info = $this->ModelMember->getList($candidate->member_id);
		$data['member_name'] = $member_info->prefix_name.' '.$member_info->firstname.' '.$member_info->lastname;

		if (!empty($candidate->image)) {
			$data['image'] = base_url().'/uploads/'.$candidate->image;
		} else {
			$data['image'] = '';
		}
		if ($this->input->post('author')) {
			$data['author'] = $this->input->post('author');
		} else {
			$data['author'] = $candidate->author;
		}
		if ($this->input->post('date_register')) {
			$data['date_register'] = $this->input->post('date_register');
		} else {
			$temp = explode('-', $candidate->date_register);
			$data['date_register'] = $temp[2].'-'.$temp[1].'-'.$temp[0];
		}
		if ($this->input->post('member_id')) {
			$data['member_id'] = $this->input->post('member_id');
		} else {
			$data['member_id'] = $candidate->member_id;
		}
		if ($this->input->post('member_id')) {
			$data['member_id'] = $this->input->post('member_id');
		} else {
			$data['member_id'] = $candidate->member_id;
		}
		if ($this->input->post('member_no')) {
			$data['member_no'] = $this->input->post('member_no');
		} else {
			$data['member_no'] = $candidate->member_no;
		}
		if ($this->input->post('age')) {
			$data['age'] = $this->input->post('age');
		} else {
			$temp = explode('-', $member_info->birthday);
			$data['age'] = date('Y',time()) - $temp[0];
		}
		if ($this->input->post('position')) {
			$data['position'] = $this->input->post('position');
		} else {
			$data['position'] = $candidate->position;
		}
		if ($this->input->post('member_year')) {
			$data['member_year'] = $this->input->post('member_year');
		} else {
			$data['member_year'] = $candidate->member_year;
		}
		if ($this->input->post('member_month')) {
			$data['member_month'] = $this->input->post('member_month');
		} else {
			$data['member_month'] = $candidate->member_month;
		}
		if ($this->input->post('member_group_name')) {
			$data['member_group_name'] = $this->input->post('member_group_name');
		} else {
			$data['member_group_name'] = $candidate->member_group_name;
		}
		if ($this->input->post('phone_office')) {
			$data['phone_office'] = $this->input->post('phone_office');
		} else {
			$data['phone_office'] = $candidate->phone_office;
		}
		if ($this->input->post('phone_office')) {
			$data['phone_office'] = $this->input->post('phone_office');
		} else {
			$data['phone_office'] = $candidate->phone_office;
		}
		if ($this->input->post('type_id')) {
			$data['type_id'] = $this->input->post('type_id');
		} else {
			$data['type_id'] = $candidate->type_id;
		}
		if ($this->input->post('phone')) {
			$data['phone'] = $this->input->post('phone');
		} else {
			$data['phone'] = $candidate->phone;
		}
		if ($this->input->post('candidate_no')) {
			$data['candidate_no'] = $this->input->post('candidate_no');
		} else {
			$data['candidate_no'] = $candidate->candidate_no;
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			// Upload
			$image = $candidate->image;

			if ($_FILES['image']['error']==0) {
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']      = '100';
				$config['max_width']     = '1440';
				$config['max_height']    = '1440';
				$config['encrypt_name']  = TRUE;
				
				$this->upload->initialize($config);

				if ( !$this->upload->do_upload('image') ) {
					$this->session->set_userdata('error', $this->upload->display_errors());
				} else {
					echo $upload_data = $this->upload->data();
					echo $image = $upload_data['file_name'];
				}
			} else if ($_FILES['image']['error']==4) {
				$image = '';
			}
			// Upload

			$token = $this->session->userdata('token');
			$member = json_decode(base64_decode($token));
			$post = $this->input->post();

			unset($post['zero_config_length']);

			$post['image'] = $image;
			$data['image'] = !empty($image) ? base_url().'/uploads/'.$image : '';
			// $post['member_id']    = $member->id;
			$post['recruiting_id'] = $recruiting_id;

			if ($this->input->post('date_register')) {
				$temp = explode('-', $this->input->post('date_register'));
				$post['date_register'] = $temp[2].'-'.$temp[1].'-'.$temp[0];
			}
			$candidate_id = $this->ModelCandidate->edit($id, $post);

			if ($candidate_id>0) {
				$this->session->set_userdata('success', 'แก้ไขผู้สมัครเรียบร้อยแล้ว');	
			} else {
				$this->session->set_userdata('error', 'ผิดพลาดในการแก้ไขผู้สมัคร');	
			}

			redirect('candidate/add/'.$recruiting_id);
			exit();
		}

		$data['recruiting_id'] = $recruiting_id;

		$data['candidates'] = array();
		$candidates = $this->ModelCandidate->getLists($recruiting_id);
		foreach ($candidates as $candidate) {
			$type_info = $this->ModelRecruiting->findType($candidate->id);
			$data['candidates'][] = array(
				'id'           => $candidate->id,
				'type_name'    => $type_info->type_name,
				'candidate_no' => $candidate->candidate_no,
				'name'         => $candidate->member_prefix.' '.$candidate->firstname.' '.$candidate->lastname,
				'member_no'    => $candidate->member_no,
				'status'       => $candidate->status,
				'edit'         => base_url('candidate/edit/'.$recruiting_id.'/'.$candidate->id)
			);
		}


		
		$types = $this->ModelRecruiting->getListsWithType($recruiting_id);
		$data['recruiting_types'] = array();

		if (count($types)>0) {
			foreach ($types as $value) {
				if ($value->recruiting_type=='committee') {
					$data['recruiting_types'][] = array(
						'id' => $value->committee_id,
						'name' => $value->committee_name
					);
				} else if ($value->recruiting_type=='members') {
					$data['recruiting_types'][] = array(
						'id' => $value->member_group_id,
						'name' => $value->member_group_name
					);
				}
			}
		}



		$data['action']              = base_url('candidate/edit/'.$recruiting_id.'/'.$id);
		$data['action_getcandidate'] = base_url('candidate/getCandidate/'.$recruiting_id);
		$data['action_status']       = base_url('candidate/status/'.$recruiting_id);
		$data['action_del']          = base_url('candidate/delete/'.$recruiting_id);
		
		if ($this->session->has_userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		} else {
			$data['success'] = '';
		}
		if ($this->session->has_userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		} else {
			$data['error'] = '';
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/form', $data); 
		$this->load->view('common/footer', $data);
    }

    public function view($recruiting_id,$id=null) 
    {
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ดูผู้สรรหา';
		$data['button_title'] = 'แก้ไขผู้สรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ดูผู้สรรหา','link'=>base_url('candidate/view/'.$recruiting_id.($id>0?'/'.$id:''))),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCandidate');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');

		if ($id>0) {
			$candidate = $this->ModelCandidate->getList($recruiting_id,$id);
			$member_info = $this->ModelMember->getList($candidate->member_id);
			$data['member_name'] = $member_info->prefix_name.' '.$member_info->firstname.' '.$member_info->lastname;

			$data['image'] = '';
			$data['author'] = $candidate->author;
			$temp = explode('-', $candidate->date_register);
			$data['date_register'] = $temp[2].'-'.$temp[1].'-'.$temp[0];
			$data['member_id'] = $candidate->member_id;
			$data['member_id'] = $candidate->member_id;
			$data['member_no'] = $candidate->member_no;
			$temp = explode('-', $member_info->birthday);
			$data['age'] = date('Y',time()) - $temp[0];
			$data['position'] = $candidate->position;
			$data['member_year'] = $candidate->member_year;
			$data['member_month'] = $candidate->member_month;
			$data['member_group_name'] = $candidate->member_group_name;
			$data['phone_office'] = $candidate->phone_office;
			$data['phone_office'] = $candidate->phone_office;
			$data['type_id'] = $candidate->type_id;
			$data['phone'] = $candidate->phone;
			$data['candidate_no'] = $candidate->candidate_no;
		} else {
			$data['member_name']       = '' ;
			$data['image']             = '';
			$data['author']            = '';
			$data['date_register']     = '';
			$data['member_id']         = '';
			$data['member_id']         = '';
			$data['member_no']         = '';
			$data['age']               = '';
			$data['position']          = '';
			$data['member_year']       = '';
			$data['member_month']      = '';
			$data['member_group_name'] = '';
			$data['phone_office']      = '';
			$data['phone_office']      = '';
			$data['type_id']           = '';
			$data['phone']             = '';
			$data['candidate_no']      = '';
		}


		$data['recruiting_id'] = $recruiting_id;

		$data['candidates'] = array();
		$candidates = $this->ModelCandidate->getLists($recruiting_id);
		foreach ($candidates as $candidate) {
			$type_info = $this->ModelRecruiting->findType($candidate->id);
			$data['candidates'][] = array(
				'recruiting_id' => $recruiting_id,
				'id'           => $candidate->id,
				'type_name'    => $type_info->type_name,
				'candidate_no' => $candidate->candidate_no,
				'name'         => $candidate->member_prefix.' '.$candidate->firstname.' '.$candidate->lastname,
				'member_no'    => $candidate->member_no,
				'status'       => $candidate->status,
				'edit'         => base_url('candidate/edit/'.$recruiting_id.'/'.$candidate->id)
			);
		}


		$data['recruiting_types'] = $this->ModelRecruiting->getListsWithType($recruiting_id);

		// $data['action']              = base_url('candidate/edit/'.$recruiting_id.'/'.$id);
		// $data['action_getcandidate'] = base_url('candidate/getCandidate/'.$recruiting_id);
		// $data['action_status']       = base_url('candidate/status/'.$recruiting_id);
		// $data['action_del']          = base_url('candidate/delete/'.$recruiting_id);
		
		if ($this->session->has_userdata('success')) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		} else {
			$data['success'] = '';
		}
		if ($this->session->has_userdata('error')) {
			$data['error'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		} else {
			$data['error'] = '';
		}

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('candidate/view', $data); 
		$this->load->view('common/footer', $data);
    }


    public function ajaxDelete($id) 
    {
    	$data['status'] = false;
    	$this->load->model('ModelCandidate');
    	$result = $this->ModelCandidate->delete($id);
    	if ($result==1) {
    		$data['status'] = true;
    	}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function delete($recruiting_id, $id) 
    {
    	$this->load->model('ModelCandidate');
    	$candidate = $this->ModelCandidate->getList($recruiting_id, $id);
    	$result = $this->ModelCandidate->delete($id);
    	if ($result==1) {
    		$this->session->set_userdata('success', 'ลบผู้สมัคร '.$candidate->member_prefix.' '.$candidate->firstname.' '.$candidate->lastname.' เรียบร้อยแล้ว');	
    	} else {
    		$this->session->set_userdata('error', 'ผิดพลาดในการ ลบผู้สมัคร ');
    	}
    	
    	redirect('candidate/add/'.$recruiting_id);
    }

    public function status($recruiting_id, $id, $status) 
    {
    	$this->load->model('ModelCandidate');
    	$candidate = $this->ModelCandidate->getList($recruiting_id, $id);
    	$this->ModelCandidate->status($id, $status);
    	$this->session->set_userdata('success', 'เปลี่ยนสถานะผู้สมัคร <b>'.$candidate->member_prefix.' '.$candidate->firstname.' '.$candidate->lastname.'</b> เป็น <b>'.($status==1?'อนุมัติ':'ตัดสิทธิ์').'</b> เรียบร้อยแล้ว');
    	redirect('candidate/add/'.$recruiting_id);
    }

	public function validate() 
	{
		if ($this->input->post('member_id')==null || (int)$this->input->post('member_id')<=0) {
			$this->error = 'กรุณาเลือก สมาชิก';
			return false;
		}

		return true;
	}

	public function countScore($recruiting_id, $typeid, $year='', $set='')
	{
		$this->load->model('ModelRecruiting');
		$this->ModelRecruiting->countScore($recruiting_id);

		redirect('Candidate/result/'.$recruiting_id.'/'.$typeid.'/'.$year.'/'.$set);
	}

	public function ajaxUpdateStatusCandidate($candidate_id) 
	{
		$this->load->model('ModelCandidate');
		$result = $this->ModelCandidate->status_pass($candidate_id, $this->input->post('status'));
		if ($result==1) {
			$this->session->set_userdata('success','ลบการรับรองสิทธิ์เรียบร้อยแล้ว');
		} else {
			$this->session->set_userdata('error', 'ไม่สามารถลบการรับรองสิทธิ์');
		}
		$data = $result;
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function ajaxGetCandidates($recruiting_id, $type_id=null) 
	{
		$this->checkLogin();
		$data = array();

		$this->load->model('ModelCandidate');
		$this->load->model('ModelRecruiting');
		$this->load->model('ModelMember');
		$lists = $this->ModelCandidate->getLists($recruiting_id, $type_id);
		foreach ($lists as $key => $value) {
			$type_info = $this->ModelRecruiting->findType($value->id);
			$member_info = $this->ModelMember->getList($value->member_id);
			$data[] = array(
				'candidate_no'      => $value->candidate_no,
				'recruiting_id'     => $recruiting_id,
				'id'                => $value->id,
				'member_id'         => $value->member_id,
				'member_group_name' => $member_info->member_group_name,
				'type_name'         => $type_info->type_name,
				'name'              => $value->member_prefix . ' ' . $value->firstname . ' ' . $value->lastname,
				'member_no'         => $value->member_no,
				'score'             => !empty($value->score) ? (int)$value->score : 0,
				'receiving'         => $type_info->receiving,
				'reserve'           => $type_info->reserve,
				'status_pass'       => $value->status_pass,
				'type_id'           => $value->type_id,
			);
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function ajaxGetCandidate($recruiting_id, $candidate_id) 
	{
		$this->checkLogin();
		$data = array();

		$this->load->model('ModelCandidate');
		$this->load->model('ModelRecruiting');
		$data = $this->ModelCandidate->getList($recruiting_id, $candidate_id);
		$recruiting = $this->ModelRecruiting->getListsWithType($recruiting_id);
		// $type_name = '';
		// if ($recruiting[0]->recruiting_type=='committee') {
		// 	$committee_info = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
		// 	$type_name = $committee_info[0]->committee_name;
		// } else if ($recruiting->recruiting_type=='members') {
		// 	$members_info = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
		// 	$type_name = $members_info[0]->committee_name;
		// }
		$type_info = $this->ModelRecruiting->findType($candidate_id);
		$data->type_name = $type_info->type_name;
		$data->name = $data->member_prefix . ' ' . $data->firstname . ' ' . $data->lastname;

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function getCandidate($recruiting_id) 
	{
		$this->checkLogin();
		$data = array();

		$this->load->model('ModelCandidate');
		$data = $this->ModelCandidate->getList($recruiting_id, $this->input->post('id'));

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function getMember()
	{
		$this->checkLogin();
		$data = array();

		$this->load->model('ModelMember');
		$data = $this->ModelMember->getList($this->input->post('id'));
		
		$data->birthday = date('d-m-Y', strtotime($data->birthday));
		$data->age = date('Y', time()) - date('Y', strtotime($data->birthday));
		$data->date_register = date('d-m-Y', strtotime($data->date_register));
		$data->status = $data->status==1?'ใช้งาน':'ไม่ใช้งาน';

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function exportCandidateCSV()
	{

		$this->checkLogin();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->model('ModelMember');
			$membergroup_info = $this->ModelMember->getGroup($this->input->post('type_id'));
			// echo '<pre>';
			// print_r($membergroup_info);
			// echo '</pre>';
			// exit();


			// Excel
			require_once dirname(__FILE__) . '/../../assets/PHPExcel-1.8/Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("MunkGorn")
			                     ->setLastModifiedBy("MunkGorn")
			                     ->setTitle("ข้อมูลผู้สมัคร")
			                     ->setSubject("ข้อมูลผู้สมัคร")
			                     ->setDescription("")
			                     ->setKeywords("")
			                     ->setCategory("");


			$objPHPExcel->getDefaultStyle()->getFont()
			->setName('TH SarabunPSK')
			->setSize(18)
			->setBold(false);

			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ตำแหน่งการสรรหา '.$membergroup_info['name']);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
			$objPHPExcel->getActiveSheet()->getStyle("A1:D1")->getFont()->setSize(20)->setBold(true);

			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'หมายเลขสมาชิก');
			$objPHPExcel->getActiveSheet()->setCellValue('B3', 'เลขที่ผู้สมัคร');
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'สมัครในนาม');
			$objPHPExcel->getActiveSheet()->setCellValue('D3', 'ปัจจุบันดำรงตำแหน่ง');
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'เป็นสมาชิกสหกณ์ (ปี)');
			$objPHPExcel->getActiveSheet()->setCellValue('F3', 'เป็นสมาชิกสหกรณ์ (เดือน)');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'โทรศัพท์');
			$objPHPExcel->getActiveSheet()->setCellValue('H3', 'มือถือ');
			$objPHPExcel->getActiveSheet()->getStyle("A3:H3")->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()->setCellValue('A4', '089999');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getNumberFormat()->setFormatCode('000000');
			$objPHPExcel->getActiveSheet()->setCellValue('B4', '1');
			$objPHPExcel->getActiveSheet()->setCellValue('C4', 'ตัวอย่าง');
			$objPHPExcel->getActiveSheet()->setCellValue('D4', 'ตำแหน่งตัวอย่าง');
			$objPHPExcel->getActiveSheet()->setCellValue('E4', '10');
			$objPHPExcel->getActiveSheet()->setCellValue('F4', '10');
			$objPHPExcel->getActiveSheet()->setCellValue('G4', '021111111');
			$objPHPExcel->getActiveSheet()->setCellValue('H4', '0866666666');
			$objPHPExcel->getActiveSheet()->getStyle("A4:H4")->getFont()->setSize(18)->setBold(false);
			$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::
				HORIZONTAL_LEFT); 
			$objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::
				VERTICAL_CENTER); 

			foreach(range('A','H') as $columnID) {
			    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลผู้สมัคร');
			$objPHPExcel->getSecurity()->setLockWindows(false);
			$objPHPExcel->getSecurity()->setLockStructure(false);
			$objPHPExcel->setActiveSheetIndex(0);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$filename = 'file_'.date('My', time()).'.xlsx';
			header('Content-type: application/vnd.ms-excel');
		     header('Content-Disposition: attachment; filename="' . $filename . '"');
		     $objWriter->save('php://output');
			exit();
			// Excel 
		}

	}

	public function importCandidateCSV()
	{
		$this->checkLogin();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$fileimport = '';
			// upload
			if ($_FILES['importfile']['error']==0) {
				$config['upload_path']   = './uploads/import_candidate/';
				$config['allowed_types'] = 'xlsx';
				$config['encrypt_name']  = TRUE;
				
				$this->upload->initialize($config);

				if ( !$this->upload->do_upload('importfile') ) {
					// $this->error = array('error' => $this->upload->display_errors());
					$this->session->set_userdata('error', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ '.$this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					$fileimport = $upload_data['file_name'];
				}
			} else {
				$this->session->set_userdata('error', 'ไม่สามารถอัพโหลดไฟล์ได้ กรุณาอัพโหลดไฟล์ .xlsx ');
			}
			// upload

			if (!empty($fileimport)) {


				$file = 'uploads/import_candidate/'.$fileimport;
				$this->load->model('ModelMember');
				$this->load->model('ModelRecruiting');
				$this->load->model('ModelCandidate');

				require_once dirname(__FILE__) . '/../../assets/XLSXReader/XLSXReader.php';
				$xlsx = new XLSXReader($file);
				$sheets = $xlsx->getSheetNames();
				$datas = $xlsx->getSheetData($sheets[1]);

                $sql = '';
                $row = 0;
                foreach ($datas as $data) {
                	if ($row>=3) {
                		// echo sprintf('%06d',$data[0]);
                		$member_info = $this->ModelMember->getListByMemberNo(sprintf('%06d',$data[0]));
                		if (isset($member_info['id']) && !empty($member_info['id']) && $member_info['id']>0) {
                			$insert = array(
								'recruiting_id'     => $this->input->post('recruiting_id'),
								'member_id'         => $member_info['id'],
								'type_id'           => $this->input->post('type_id'),
								'author'            => $data[2],
								'date_register'     => $member_info['date_register'],
								'member_no'         => $member_info['member_no'],
								'image'             => '',
								'age'               => null,
								'position'          => $data[3],
								'member_year'       => $data[4],
								'member_month'      => $data[5],
								'member_group_name' => $member_info['member_group_name'],
								'phone_office'      => $data[6],
								'phone'             => $data[7],
								'candidate_no'      => $data[1],
								'score'             => null
							);

							$this->ModelCandidate->add($insert);
                		}
                	}
                	
                	$row++;
                }

				redirect('Candidate/Add/'.$this->input->post('recruiting_id'));
                exit();

				// $result = $this->ModelMember->importGroupCSV($file);
				// $row = 1;
				// if (($handle = fopen($file, "r")) !== FALSE) {

				// 	$token = $this->session->userdata('token');
				// 	$member = json_decode(base64_decode($token));

				// 	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				// 		$num = count($data);

				// 		$member_info = $this->ModelMember->getListByMemberNo($data[0]);

				// 		if ($row>3) {
				// 			if ($data[0]>0 && $member_info['id'] > 0) {
				// 				$insert = array(
				// 					'recruiting_id'     => $this->input->post('recruiting_id'),
				// 					'member_id'         => $member_info['id'],
				// 					'type_id'           => $this->input->post('type_id'),
				// 					'author'            => $data[2],
				// 					'date_register'     => $member_info['date_register'],
				// 					'member_no'         => $member_info['member_no'],
				// 					'image'             => '',
				// 					'age'               => null,
				// 					'position'          => $data[3],
				// 					'member_year'       => $data[4],
				// 					'member_month'      => $data[5],
				// 					'member_group_name' => $member_info['member_group_name'],
				// 					'phone_office'      => $data[6],
				// 					'phone'             => $data[7],
				// 					'candidate_no'      => $data[1],
				// 					'score'             => null
				// 				);
				// 				// echo '<pre>';
				// 				// print_r($insert);
				// 				// echo '</pre>';
				// 				$this->ModelCandidate->add($insert);
				// 			}
				// 		}
				// 		$row++;
				// 	}

				// 	fclose($handle);
				// 	redirect('Candidate/Add/'.$this->input->post('recruiting_id'));
				// } // end if read
			} // end if file
		} // end if post

		// redirect('recruiting');
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