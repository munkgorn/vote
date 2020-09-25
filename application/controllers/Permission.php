<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->checkLogin();

    }

    public function index() 
    {
    	$this->checkPermission('S11_ROLE_PERMISSION');
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ตั้งค่าสิทธิ์การใช้งาน';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ตั้งค่าสิทธิ์การใช้งาน','link'=>base_url('permission')),
		);

		if ($this->input->post('member_type_id')=='') {
			$this->session->unset_userdata('member_type_id');
		}

		if ($this->input->post('member_type_id')&&$this->input->post('member_type_id')>0) {
			$data['member_type_id'] = $this->input->post('member_type_id');
			$this->session->set_userdata('member_type_id', $this->input->post('member_type_id'));
		} else if ($this->session->has_userdata('member_type_id')) {
			$data['member_type_id'] = $this->session->userdata('member_type_id');
		} else {
			$data['member_type_id'] = '';
			$this->session->set_userdata('member_type_id', '');
		}

		$this->load->model('ModelMember');
		$data['types'] = $this->ModelMember->getTypes();

		$this->load->model('ModelPermission');
		$data['permissions'] = $this->ModelPermission->getPermissions();
		$data['permission_list'] = array();
		if ($this->input->post('member_type_id')) {
			$permission_infos = $this->ModelPermission->getMemberToPermission($this->input->post('member_type_id'));	
			foreach ($permission_infos as $permission_info) {
				$data['permission_list'][$permission_info->permission_id] = $permission_info->status;	
			}
		}

		
		$data['action'] = base_url('permission/edit');
		$data['action_change'] = base_url('permission');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('permission/index', $data); 
		$this->load->view('common/footer', $data);
    }

    public function edit()
    {
    	$this->checkPermission('S11_ROLE_PERMISSION');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->model('ModelPermission');

			$token = $this->session->userdata('token');
			$json = json_decode(base64_decode($token));
			if ($this->input->post('member_type_id')) {
				$member_type_id = $this->input->post('member_type_id');
			} else if ($this->session->has_userdata('member_type_id')) {
				$member_type_id = $this->session->userdata('member_type_id');
			} else {
				$member_type_id = $json->member_type_id;
			}
			$this->session->set_userdata('member_type_id', $member_type_id);

			$this->ModelPermission->editPermission($member_type_id, $this->input->post('permission_id'));

			redirect('permission');
		}
    }

    public function Noaccess()
    {
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ไม่มีสิทธิ์ในการเข้าใช้งาน';
		$data['detail'] = 'คุณไม่มีสิทธิ์ในการเข้าใช้งานหน้านี้';

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('permission/permission', $data); 
		$this->load->view('common/footer', $data);
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