<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruiting extends CI_Controller {

	public $error = null;

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
    }

    public function updateTable() 
    {
    	$this->load->model('ModelRecruiting');
    	echo $this->ModelRecruiting->updateTable();
    }

    public function index()
    {
		$this->checkPermission('S04_MANAGE_CONTEST');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'จัดการวาระการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการวาระการสรรหา','link'=>base_url('recruiting')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');

		$token = $this->session->userdata('token');
		$member = json_decode(base64_decode($token));

		$recruitings = $this->ModelRecruiting->getLists();
		$data['recruitings'] = array();
		$i=1;
		foreach ($recruitings as $key => $value) {
			if ($value->recruiting_type=='committee') {
				$list = array();
				$lists_committee = $this->ModelRecruiting->getRecruitingCommittee($value->id);
				foreach ($lists_committee as $list_committee) {
					$list[] = $list_committee->committee_name;
				}
			}
			if ($value->recruiting_type=='members') {
				$list = array();
				$lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
				foreach ($lists_members as $list_member) {
					// if ($member->member_group_id==$list_member->type_id) {
						$list[] = $list_member->member_group_name;	
					// }
				}
			}

			$now = time();
			$date_register_start = strtotime($value->date_register_start);
			$date_register_end = strtotime($value->date_register_end);
			$date_score_start = strtotime($value->date_score_start);
			$date_score_end = strtotime($value->date_score_end);
			$status = '';
			if ($now>$date_register_start) {
				$status = 'Open';
			}
			if ($now>$date_register_end) {
				$status = 'Close';
			}
			if ($now>$date_score_start) {
				$status = 'Vote';
			}
			if ($now>$date_score_end) {
				$status = 'Complete';
			}
			
			$data['recruitings'][] = array(
				'id'          => $value->id,
				'sort'        => $value->sort,
				'no'          => $i++,
				'type'        => $value->recruiting_type=='committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก',
				'list'        => implode(',', $list),
				'set'         => $value->set,
				'year'        => $value->year,
				'no'          => $value->no,
				'status_text' => $status,
				'status'      => $value->status
			);
		}


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

		$data['committees'] = $this->ModelCommittee->getLists();	
		$regions = $this->ModelRegion->getLists();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$region->member_groups = $this->ModelMember->getGroups($filter);
			$data['regions'][] = $region;
		}
		$this->load->model('ModelDocument');
		$data['documents'] = $this->ModelDocument->getLists();


		$data['action_add']    = base_url('recruiting/add');
		$data['action_get'] = base_url('recruiting/getRecruiting/');
		$data['action_edit']   = base_url('recruiting/edit/');
		$data['action_del']    = base_url('recruiting/delete/');
		$data['action_delete_candidate'] = base_url('candidate/ajaxDelete/');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('recruiting/list', $data); 
		$this->load->view('common/footer', $data);
    }

	public function add()
	{
		$this->checkPermission('S03_CREATE_CONTEST');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'สร้างวาระการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการวาระการสรรหา','link'=>base_url('recruiting')),
			array('name'=>'สร้างวาระการสรรหา','link'=>base_url('recruiting/add')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');


		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$token = $this->session->userdata('token');
			$member = json_decode(base64_decode($token));
			$post = $this->input->post();

			if ($this->input->post('date_register_start')) {
				$temp = explode('-', $this->input->post('date_register_start'));
				$post['date_register_start'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_register_start').':00';
			}
			if ($this->input->post('date_register_end')) {
				$temp = explode('-', $this->input->post('date_register_end'));
				$post['date_register_end'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_register_end').':00';
			}
			if ($this->input->post('date_score_start')) {
				$temp = explode('-', $this->input->post('date_score_start'));
				$post['date_score_start'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_score_start').':00';
			}
			if ($this->input->post('date_score_end')) {
				$temp = explode('-', $this->input->post('date_score_end'));
				$post['date_score_end'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_score_end').':00';
			}

			if ($post['recruiting_type']=='committee') {
				$post['committee'] = array(
					'receiving' => $post['committee_receiving'],
					'reserve'   => $post['committee_reserve']
				);
				unset($post['members']);
			} else if ($post['recruiting_type']=='members') {
				$post['members'] = array(
					'receiving' => $post['member_receiving'],
					'reserve'   => $post['member_reserve']
				);
				unset($post['committee']);
			}
			unset($post['committee_receiving'], $post['committee_reserve'], $post['member_receiving'], $post['member_reserve'],$post['time_register_start'],$post['time_register_end'],$post['time_score_start'],$post['time_score_end']);

			$post['member_id'] = $member->id;
			$recruiting_id = $this->ModelRecruiting->add($post);

			redirect('Candidate/Add/'.$recruiting_id);
			exit();
		}


		if ($this->input->post('sort')) {
			$data['sort'] = (int)$this->input->post('sort');
		} else {
			$data['sort'] = $this->ModelRecruiting->getSort();
		}
		if ($this->input->post('set')) {
			$data['set'] = $this->input->post('set');
		} else {
			$data['set'] = '';
		}
		if ($this->input->post('year')) {
			$data['year'] = $this->input->post('year');
		} else {
			$data['year'] = '';
		}
		if ($this->input->post('no')) {
			$data['no'] = $this->input->post('no');
		} else {
			$data['no'] = '';
		}
		if ($this->input->post('recruiting_type')) {
			$data['recruiting_type'] = $this->input->post('recruiting_type');
		} else {
			$data['recruiting_type'] = '';
		}
		if ($this->input->post('date_register_start')) {
			$data['date_register_start'] = $this->input->post('date_register_start');
		} else {
			$data['date_register_start'] = '';
		}
		if ($this->input->post('date_register_end')) {
			$data['date_register_end'] = $this->input->post('date_register_end');
		} else {
			$data['date_register_end'] = '';
		}
		if ($this->input->post('date_score_start')) {
			$data['date_score_start'] = $this->input->post('date_score_start');
		} else {
			$data['date_score_start'] = '';
		}
		if ($this->input->post('date_score_end')) {
			$data['date_score_end'] = $this->input->post('date_score_end');
		} else {
			$data['date_score_end'] = '';
		}

		if ($this->input->post('time_register_start')) {
			$data['time_register_start'] = $this->input->post('time_register_start');
		} else {
			$data['time_register_start'] = '';
		}
		if ($this->input->post('time_register_end')) {
			$data['time_register_end'] = $this->input->post('time_register_end');
		} else {
			$data['time_register_end'] = '';
		}
		if ($this->input->post('time_score_start')) {
			$data['time_score_start'] = $this->input->post('time_score_start');
		} else {
			$data['time_score_start'] = '';
		}
		if ($this->input->post('time_score_end')) {
			$data['time_score_end'] = $this->input->post('time_score_end');
		} else {
			$data['time_score_end'] = '';
		}

		if ($this->input->post('committee')) {
			$data['committee'] = $this->input->post('committee');
		} else {
			$data['committee'] = null;
		}
		if ($this->input->post('committee_receiving')) {
			$data['committee_receiving'] = $this->input->post('committee_receiving');
		} else {
			$data['committee_receiving'] = null;
		}
		if ($this->input->post('committee_reserve')) {
			$data['committee_reserve'] = $this->input->post('committee_reserve');
		} else {
			$data['committee_reserve'] = null;
		}
		if ($this->input->post('detail')) {
			$data['detail'] = $this->input->post('detail');
		} else {
			$data['detail'] = '';
		}

		

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


		$data['committees'] = $this->ModelCommittee->getLists();
		$regions = $this->ModelRegion->getLists();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$region->member_groups = $this->ModelMember->getGroups($filter);
			$data['regions'][] = $region;
		}
		$data['documents'] = $this->ModelDocument->getLists();
		$data['members'] = $this->ModelMember->getLists();

		$data['has_candidate'] = false;

		$data['export_member'] = base_url('Member/exportGroupCSV');
		$data['import_group'] = base_url('Member/importGroupCSV');

		$data['action'] = base_url('recruiting/add');
		$data['action_edit'] = base_url('recruiting/edit');
		$data['action_del'] = base_url('recruiting/delete');
		$data['action_back'] = base_url('recruiting');
		// $data['news_types'] = $this->ModelNews->getTypes();

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('recruiting/form', $data); 
		$this->load->view('common/footer', $data);
	}

	public function edit($recruiting_id)
	{
		$this->checkPermission('S04_MANAGE_CONTEST');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'แก้ไขวาระการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการวาระการสรรหา','link'=>base_url('recruiting')),
			array('name'=>'แก้ไขวาระการสรรหา','link'=>base_url('recruiting/edit/'.$recruiting_id)),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelCandidate');
		$this->load->model('ModelRegion');
		$this->load->model('ModelDocument');

		$recruiting_info = $this->ModelRecruiting->getList($recruiting_id);

		$candidates = $this->ModelCandidate->getLists($recruiting_id);
		$data['has_candidate'] = false;
		if (count($candidates)>0) {
			$data['has_candidate'] = true;
		}
		$data['has_candidate'] = false;

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$token = $this->session->userdata('token');
			$member = json_decode(base64_decode($token));
			$post = $this->input->post();

			if ($this->input->post('date_register_start')) {
				$temp = explode('-', $this->input->post('date_register_start'));
				$post['date_register_start'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_register_start').':00';
			}
			if ($this->input->post('date_register_end')) {
				$temp = explode('-', $this->input->post('date_register_end'));
				$post['date_register_end'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_register_end').':00';
			}
			if ($this->input->post('date_score_start')) {
				$temp = explode('-', $this->input->post('date_score_start'));
				$post['date_score_start'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_score_start').':00';
			}
			if ($this->input->post('date_score_end')) {
				$temp = explode('-', $this->input->post('date_score_end'));
				$post['date_score_end'] = $temp[2].'-'.$temp[1].'-'.$temp[0].' '.$this->input->post('time_score_end').':00';
			}

			if ($post['recruiting_type']=='committee') {
				$post['committee'] = array(
					'receiving' => $post['committee_receiving'],
					'reserve'   => $post['committee_reserve']
				);
				unset($post['members']);
			} else if ($post['recruiting_type']=='members') {
				$post['members'] = array(
					'receiving' => $post['member_receiving'],
					'reserve'   => $post['member_reserve']
				);
				unset($post['committee']);
			}
			unset($post['committee_receiving'], $post['committee_reserve'], $post['member_receiving'], $post['member_reserve'],$post['time_register_start'],$post['time_register_end'],$post['time_score_start'],$post['time_score_end']);

			// echo '<pre>';
			// print_r($post);
			// echo '</pre>';
			// exit();

			$post['member_id'] = $member->id;
			$result = $this->ModelRecruiting->edit($recruiting_id, $post);
			if ($result==1) {
				$this->session->set_userdata('success', 'แก้ไขวาระการสรรหา สำเร็จ');
			} else {
				$this->session->set_userdata('error', 'ผิดพลาดในการ แก้ไขวาระการสรรหา');
			}

			redirect('candidate/add/'.$recruiting_id);
		}

		if ($this->input->post('sort')) {
			$data['sort'] = $this->input->post('sort');
		} else {
			$data['sort'] = $recruiting_info->sort;
		}
		if ($this->input->post('set')) {
			$data['set'] = $this->input->post('set');
		} else {
			$data['set'] = $recruiting_info->set;
		}
		if ($this->input->post('year')) {
			$data['year'] = $this->input->post('year');
		} else {
			$data['year'] = $recruiting_info->year;
		}
		if ($this->input->post('no')) {
			$data['no'] = $this->input->post('no');
		} else {
			$data['no'] = $recruiting_info->no;
		}
		if ($this->input->post('recruiting_type')) {
			$data['recruiting_type'] = $this->input->post('recruiting_type');
		} else {
			$data['recruiting_type'] = $recruiting_info->recruiting_type;
		}
		if ($this->input->post('date_register_start')) {
			$data['date_register_start'] = $this->input->post('date_register_start');
		} else {
			$data['date_register_start'] = date('d-m-Y', strtotime($recruiting_info->date_register_start));
		}
		if ($this->input->post('date_register_end')) {
			$data['date_register_end'] = $this->input->post('date_register_end');
		} else {
			$data['date_register_end'] = date('d-m-Y', strtotime($recruiting_info->date_register_end));
		}
		if ($this->input->post('date_score_start')) {
			$data['date_score_start'] = $this->input->post('date_score_start');
		} else {
			$data['date_score_start'] = date('d-m-Y', strtotime($recruiting_info->date_score_start));
		}
		if ($this->input->post('date_score_end')) {
			$data['date_score_end'] = $this->input->post('date_score_end');
		} else {
			$data['date_score_end'] = date('d-m-Y', strtotime($recruiting_info->date_score_end));
		}
 
		if ($this->input->post('time_register_start')) {
			$data['time_register_start'] = $this->input->post('time_register_start');
		} else {
			$data['time_register_start'] = date('H:i', strtotime($recruiting_info->date_register_start));
		}
		if ($this->input->post('time_register_end')) {
			$data['time_register_end'] = $this->input->post('time_register_end');
		} else {
			$data['time_register_end'] = date('H:i', strtotime($recruiting_info->date_register_end));
		}
		if ($this->input->post('time_score_start')) {
			$data['time_score_start'] = $this->input->post('time_score_start');
		} else {
			$data['time_score_start'] = date('H:i', strtotime($recruiting_info->date_score_start));
		}
		if ($this->input->post('time_score_end')) {
			$data['time_score_end'] = $this->input->post('time_score_end');
		} else {
			$data['time_score_end'] = date('H:i', strtotime($recruiting_info->date_score_end));
		}

		if ($this->input->post('committee')) {
			$data['committee'] = $this->input->post('committee');
		} else if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee'][$list->committee_id] = 1;
				}
			}
		} else {
			$data['committee'] = array();
		}
		if ($this->input->post('committee_receiving')) {
			$data['committee_receiving'] = $this->input->post('committee_receiving');
		} else if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee_receiving'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee_receiving'][$list->committee_id] = $list->receiving;
				}
			}
		} else {
			$data['committee_receiving'] = array();
		}
		if ($this->input->post('committee_reserve')) {
			$data['committee_reserve'] = $this->input->post('committee_reserve');
		} else if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee_reserve'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee_reserve'][$list->committee_id] = $list->reserve;
				}
			}
		} else {
			$data['committee_reserve'] = array();
		}

		if ($this->input->post('member_group')) {
			$data['member_group'] = $this->input->post('member_group');
		} else if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group'][$list->member_group_id] = 1;
				}
			}
		} else {
			$data['member_group'] = array();
		}
		if ($this->input->post('member_group_receiving')) {
			$data['member_group_receiving'] = $this->input->post('member_group_receiving');
		} else if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			$data['member_group_receiving'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group_receiving'][$list->member_group_id] = $list->receiving;
				}
			}
		} else {
			$data['member_group_receiving'] = array();
		}
		if ($this->input->post('member_group_reserve')) {
			$data['member_group_reserve'] = $this->input->post('member_group_reserve');
		} else if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			$data['member_group_reserve'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group_reserve'][$list->member_group_id] = $list->reserve;
				}
			}
		} else {
			$data['member_group_reserve'] = array();
		}

		if ($this->input->post('detail')) {
			$data['detail'] = $this->input->post('detail');
		} else {
			$data['detail'] = $recruiting_info->detail;
		}
		if ($this->input->post('file')) {
			$data['file'] = $this->input->post('file');
		} else {
			$file = $this->ModelRecruiting->getRecruitingFile($recruiting_id);
			$data['file'] = array();
			$data['filelist'] = '';
			if (count($file)>0) {
				foreach ($file as $value) {
					$data['file'][$value->document_id] = $value->document_name;
					$temp[] = $value->document_id;
				}
				$data['filelist'] = implode(',', $temp);
			}
		}

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit();
		
		// default data
		$data['committees'] = $this->ModelCommittee->getLists();
		$regions = $this->ModelRegion->getLists();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$region->member_groups = $this->ModelMember->getGroups($filter);
			$data['regions'][] = $region;
		}
		$data['documents'] = $this->ModelDocument->getLists();
		

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

		// $data['export_member'] = base_url('Member/exportGroupCSV');
		// $data['import_group'] = base_url('Member/importGroupCSV');
		$data['export_member'] = '';
		$data['import_group'] = '';



		$data['action'] = base_url('recruiting/edit/'.$recruiting_id);
		$data['action_back'] = base_url('recruiting');
		$data['action_next'] = base_url('candidate/add/'.$recruiting_id);

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('recruiting/form', $data); 
		$this->load->view('common/footer', $data);
	}

	public function view($recruiting_id)
	{
		$this->checkPermission('S04_MANAGE_CONTEST');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ดูวาระการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการวาระการสรรหา','link'=>base_url('recruiting')),
			array('name'=>'ดูวาระการสรรหา','link'=>base_url('recruiting/view/'.$recruiting_id)),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelDocument');

		$recruiting_info = $this->ModelRecruiting->getList($recruiting_id);

		$data['set'] = $recruiting_info->set;
		$data['year'] = $recruiting_info->year;
		$data['no'] = $recruiting_info->no;
		$data['recruiting_type'] = $recruiting_info->recruiting_type;
		$data['date_register_start'] = date('d-m-Y', strtotime($recruiting_info->date_register_start));
		$data['date_register_end'] = date('d-m-Y', strtotime($recruiting_info->date_register_end));
		$data['date_score_start'] = date('d-m-Y', strtotime($recruiting_info->date_score_start));
		$data['date_score_end'] = date('d-m-Y', strtotime($recruiting_info->date_score_end));
		
		if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee'][$list->committee_id] = 1;
				}
			}
		} 
		if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee_receiving'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee_receiving'][$list->committee_id] = $list->receiving;
				}
			}
		}
		if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($recruiting_id);
			$data['committee_reserve'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['committee_reserve'][$list->committee_id] = $list->reserve;
				}
			}
		}

		if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group'][$list->member_group_id] = 1;
				}
			}
		}
		if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			$data['member_group_receiving'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group_receiving'][$list->member_group_id] = $list->receiving;
				}
			}
		}
		if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($recruiting_id);
			$data['member_group_reserve'] = array();
			if (count($lists)>0) {
				foreach ($lists as $list) {
					$data['member_group_reserve'][$list->member_group_id] = $list->reserve;
				}
			}
		}
		$data['detail'] = $recruiting_info->detail;
		$file = $this->ModelRecruiting->getRecruitingFile($recruiting_id);
		$data['file'] = array();
		$data['filelist'] = '';
		if (count($file)>0) {
			foreach ($file as $value) {
				$data['file'][$value->document_id] = $value->document_name;
				$temp[] = $value->document_id;
			}
			$data['filelist'] = implode(',', $temp);
		}
		
		// default data
		$data['committees'] = $this->ModelCommittee->getLists();
		$regions = $this->ModelRegion->getLists();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$region->member_groups = $this->ModelMember->getGroups($filter);
			$data['regions'][] = $region;
		}
		$data['documents'] = $this->ModelDocument->getLists();

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

		$data['action_back'] = base_url('Recruiting');
		$data['action_view_candidate'] = base_url('Candidate/view/'.$recruiting_id);

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('recruiting/view', $data); 
		$this->load->view('common/footer', $data);
	}

	public function delete($id)
	{
		$this->checkPermission('S04_MANAGE_CONTEST');
		$this->load->model('ModelRecruiting');
		$result = $this->ModelRecruiting->delete($id);
		if ($result==1) {
			$this->session->set_userdata('success', 'ลบวาระการสรรหา เรียบร้อยแล้ว');
		} else {
			$this->session->set_userdata('error', 'ผิดพลาดในการ ลบวาระการสรรหา');
		}

		redirect('recruiting');
	}

	public function confirm($recruiting_id) 
	{
		$this->load->model('ModelRecruiting');
		$this->ModelRecruiting->changeStatus($recruiting_id, 1);
		redirect('recruiting');
	}

	public function getRecruiting($id)
	{
		$this->checkPermission('S04_MANAGE_CONTEST');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ผู้สมัครรับการสรรหา';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ผู้สมัครรับการสรรหา','link'=>base_url('recruiting')),
		);

		$this->load->model('ModelRecruiting');
		$this->load->model('ModelCommittee');
		$this->load->model('ModelRegion');
		$this->load->model('ModelMember');
		$this->load->model('ModelDocument');
		$this->load->model('ModelMember');

		$recruiting_info = $this->ModelRecruiting->getList($id);

		if ($recruiting_info->recruiting_type=='committee') {
			$lists = $this->ModelRecruiting->getRecruitingCommittee($id);
			foreach ($lists as $list) {
				$data['lists'][$list->committee_id] = array(
					'name' => $list->committee_name,
					'receiving' => $list->receiving,
					'reserve'   => $list->reserve
				);
			}
		} else if ($recruiting_info->recruiting_type=='members') {
			$lists = $this->ModelRecruiting->getRecruitingMemberGroup($id);
			foreach ($lists as $list) {
				$data['lists'][$list->member_group_id] = array(
					'name' => $list->member_group_name,
					'receiving' => $list->receiving,
					'reserve'   => $list->reserve
				);
			}
		}

		if ($this->input->post('set')) {
			$data['set'] = $this->input->post('set');
		} else {
			$data['set'] = $recruiting_info->set;
		}
		if ($this->input->post('year')) {
			$data['year'] = $this->input->post('year');
		} else {
			$data['year'] = $recruiting_info->year;
		}
		if ($this->input->post('no')) {
			$data['no'] = $this->input->post('no');
		} else {
			$data['no'] = $recruiting_info->no;
		}
		if ($this->input->post('recruiting_type')) {
			$data['recruiting_type'] = $this->input->post('recruiting_type');
		} else {
			$data['recruiting_type'] = $recruiting_info->recruiting_type;
		}
		if ($this->input->post('date_register_start')) {
			$data['date_register_start'] = $this->input->post('date_register_start');
		} else {
			$data['date_register_start'] = date('d-m-Y', strtotime($recruiting_info->date_register_start));
		}
		if ($this->input->post('date_register_end')) {
			$data['date_register_end'] = $this->input->post('date_register_end');
		} else {
			$data['date_register_end'] = date('d-m-Y', strtotime($recruiting_info->date_register_end));
		}
		if ($this->input->post('date_score_start')) {
			$data['date_score_start'] = $this->input->post('date_score_start');
		} else {
			$data['date_score_start'] = date('d-m-Y', strtotime($recruiting_info->date_score_start));
		}
		if ($this->input->post('date_score_end')) {
			$data['date_score_end'] = $this->input->post('date_score_end');
		} else {
			$data['date_score_end'] = date('d-m-Y', strtotime($recruiting_info->date_score_end));
		}
		if ($this->input->post('committee')) {
			$data['committee'] = $this->input->post('committee');
		} else {
			$data['committee'] = '';
		}
		if ($this->input->post('committee_receiving')) {
			$data['committee_receiving'] = $this->input->post('committee_receiving');
		} else {
			$data['committee_receiving'] = '';
		}
		if ($this->input->post('committee_reserve')) {
			$data['committee_reserve'] = $this->input->post('committee_reserve');
		} else {
			$data['committee_reserve'] = '';
		}
		if ($this->input->post('detail')) {
			$data['detail'] = $this->input->post('detail');
		} else {
			$data['detail'] = $recruiting_info->detail;
		}


		$this->load->model('ModelCandidate');
		$data['candidates'] = array();
		$candidates = $this->ModelCandidate->getLists($recruiting_info->id);
		foreach ($candidates as $value) {
			$data['candidates'][] = array(
				'recruiting_id' => $recruiting_info->id,
				'id'            => $value->id,
				'position'      => $value->position,
				'candidate_no'  => $value->candidate_no,
				'name'          => $value->member_prefix.' '.$value->firstname.' '.$value->lastname,
				'member_no'     => $value->member_no,
				'status'        => $value->status,
				'edit'          => base_url('candidate/edit/'.$recruiting_info->id.'/'.$value->id),
				'action_status' => base_url('candidate/status/'.$recruiting_info->id)
			);
		}

		$data['committees'] = $this->ModelCommittee->getLists();



		$regions = $this->ModelRegion->getLists();
		foreach ($regions as $region) {
			$filter['region_id'] = $region->id;
			$region->member_groups = $this->ModelMember->getGroups($filter);
			$data['regions'][] = $region;
		}
		$data['documents'] = $this->ModelDocument->getLists();
		$data['members'] = $this->ModelMember->getLists();


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

		$data['action_add'] = base_url('recruiting/add');
		$data['action_edit'] = base_url('recruiting/edit');
		$data['action_del'] = base_url('recruiting/delete');
		// $data['news_types'] = $this->ModelNews->getTypes();

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}


    public function ajaxFilterSetByYear()
    {
		$this->load->model('ModelRecruiting');
		$sets = $this->ModelRecruiting->getListsGroupBySet($this->input->post('year'));
		$data['sets'] = array();
		if (count($sets)>0) {
			foreach ($sets as $set) {
				$data['sets'][] = $set->set;
			}
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function ajaxFilterCandidate()
    {
		$this->load->model('ModelRecruiting');
		$filter = $this->input->post();
		$filter['year'] = $filter['year'];
		$filter['set'] = $filter['setvalue'];
		unset($filter['setvalue']);
		$lists = $this->ModelRecruiting->getListsByYearSet($filter);
		$i=1;
		// echo '<pre>';
		// print_r($lists);
		// echo '</pre>';
		if (count($lists)>0) {
			foreach ($lists as $value) {
				if ($value->recruiting_type=='committee') {
					$lists_committee = $this->ModelRecruiting->getRecruitingCommittee($value->id);
					foreach ($lists_committee as $list_committee) {
						$list[] = array(
							'name' => $list_committee->committee_name,
							'type_id' => $list_committee->type_id,
						);
					}
				}
				if ($value->recruiting_type=='members') {
					$lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
					foreach ($lists_members as $list_member) {
						$list[] = array(
							'name' => $list_member->member_group_name,
							'type_id' => $list_member->type_id,
						);
					}
				}

				$now = time();
				$date_register_start = strtotime($value->date_register_start);
				$date_register_end = strtotime($value->date_register_end);
				$date_score_start = strtotime($value->date_score_start);
				$date_score_end = strtotime($value->date_score_end);
				$status = '';
				if ($now>$date_register_start) {
					$status = 'Open';
				}
				if ($now>$date_register_end) {
					$status = 'Close';
				}
				if ($now>$date_score_start) {
					$status = 'Vote';
				}
				if ($now>$date_score_end) {
					$status = 'Complete';
				}

				foreach ($list as $value2) {
					$data['lists'][] = array(
						'recruiting_id'   => $value->id,
						'type_id'         => $value2['type_id'],
						'i'               => $i++,
						'recruiting_type' => $value->recruiting_type=='committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก',
						'type_name'        => $value2['name'],
						'year'            => $value->year,
						'set'             => $value->set,
						'no'              => $value->no,
						'status'          => $status
					);
				}
			}
		}
		// $data['lists'] = $lists;

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

	public function validate() 
	{
		if ($this->input->post('set')==null || (int)$this->input->post('set')<=0) {
			$this->error = 'กรุณากรอก ชุดที่ เป็นตัวเลข';
			return false;
		}
		else if ($this->input->post('year')==null || (int)$this->input->post('set')<=0) {
			$this->error = 'กรุณากรอก ปีบัญชีที่ เป็นตัวเลขปี พ.ศ. 4 หลัก เช่น '.(date('Y',time())+543);
			return false;
		}
		else if ($this->input->post('no')==null || (int)$this->input->post('set')<=0) {
			$this->error = 'กรุณากรอก ครั้งที่สรรหา เป็นตัวเลข';
			return false;
		}
		else if ($this->input->post('recruiting_type')==null || !in_array($this->input->post('recruiting_type'), array('committee','members'))) {
			$this->error = 'กรุณาเลือก ประเภทการสรรหา สรรหาคณะกรรมการดำเนินการ หรือ สรรหาผู้แทนสมาชิก เท่านั้น';
			return false;
		}
		else if ($this->input->post('date_register_start')==null) {
			$this->error = 'กรุณาเลือก วันที่ เปิด-ปิด รับสมัคร';
			return false;
		}
		else if ($this->input->post('date_register_end')==null) {
			$this->error = 'กรุณาเลือก วันที่ เปิด-ปิด รับสมัคร';
			return false;
		}
		else if ($this->input->post('date_score_start')==null) {
			$this->error = 'กรุณาเลือก วันลงคะแนน';
			return false;
		}
		else if ($this->input->post('date_score_end')==null) {
			$this->error = 'กรุณาเลือก วันลงคะแนน';
			return false;
		}

		return true;
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
