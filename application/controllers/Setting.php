<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
		$this->checkPermission('S12_DOMAIN_CONTEXT');
    }

	public function index()
	{
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'ตั้งค่าระบบ';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'ตั้งค่าระบบ','link'=>base_url('setting')),
		);

		$this->load->model('ModelNews');
		$types = $this->ModelNews->getTypes();
		foreach ($types as $key => $type) {
			$data['types'][] = array(
				'id'     => $type->id,
				'no'     => ++$key,
				'name'   => $type->name,
				'status' => ($type->status==1 ? 'Active' : 'Deactive'),
				'edit'   => base_url('setting/edittype/'),
				'view'   => base_url('setting/getType/'),
				'delete' => base_url('setting/deletetype/'.$type->id)
			);
		}

		$this->load->model('ModelDocument');
		$documents = $this->ModelDocument->getLists();
		foreach ($documents as $key => $document) {
			$data['documents'][] = array(
				'id'     => $document->id,
				'no'     => ++$key,
				'name'   => $document->name,
				'status' => ($document->status==1 ? 'Active' : 'Deactive'),
				'edit'   => base_url('setting/editdocument/'),
				'view'   => base_url('setting/getdocument/'),
				'delete' => base_url('setting/deletedocument/'.$document->id)
			);
		}

		$this->load->model('ModelMember');
		$members = $this->ModelMember->getPrefixs();
		foreach ($members as $key => $member) {
			$data['members'][] = array(
				'id'     => $member->id,
				'no'     => ++$key,
				'name'   => $member->name,
				'status' => ($member->status==1 ? 'Active' : 'Deactive'),
				'edit'   => base_url('setting/editPrefix/'),
				'view'   => base_url('setting/getPrefix/'),
				'delete' => base_url('setting/deletePrefix/'.$member->id)
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

		$data['action'] = base_url('setting/index/');
		$data['action_addtype'] = base_url('setting/addtype');
		$data['action_adddocument'] = base_url('setting/adddocument');
		$data['action_addprefix'] = base_url('setting/addPrefix');

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('setting/index', $data); 
		$this->load->view('common/footer', $data);
	}




	public function addPrefix()
	{
		$this->load->model('ModelMember');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$adddata = $this->input->post();
			$result = $this->ModelMember->addPrefix($adddata);
			if ($result==1) {
				$this->session->set_userdata('success', 'เพิ่มประเภทคำนำหน้าชื่อสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}
	}

	public function editPrefix($id)
	{
		$this->load->model('ModelMember');
		$data = $this->ModelMember->getPrefix($id);

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$update = $this->input->post();
			$result = $this->ModelMember->editPrefix($id, $update);
			if ($result==1) {
				$this->session->set_userdata('success', 'แก้ไขประเภทคำนำหน้าชื่อสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function deletePrefix($id)
	{
		$this->load->model('ModelMember');
		$result = $this->ModelMember->deletePrefix($id);
		if ($result==1) {
			$this->session->set_userdata('success', 'ลบประเภทคำนำหน้าชื่อสำเร็จ');
		} else {
			$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
		}
		redirect('setting');
	}

	public function getPrefix($id)
	{
		$this->load->model('ModelMember');
		$data = $this->ModelMember->getPrefix($id);
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	} 


	public function addDocument()
	{
		$this->load->model('ModelDocument');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$adddata = $this->input->post();
			$result = $this->ModelDocument->addDocument($adddata);
			if ($result==1) {
				$this->session->set_userdata('success', 'เพิ่มประเภทเอกสารสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}
	}

	public function editDocument($id)
	{
		$this->load->model('ModelDocument');
		$data = $this->ModelDocument->getList($id);

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$update = $this->input->post();
			$result = $this->ModelDocument->editDocument($id, $update);
			if ($result==1) {
				$this->session->set_userdata('success', 'แก้ไขประเภทเอกสารสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function deleteDocument($id)
	{
		$this->load->model('ModelDocument');
		$result = $this->ModelDocument->deleteDocument($id);
		if ($result==1) {
			$this->session->set_userdata('success', 'ลบประเภทเอกสารสำเร็จ');
		} else {
			$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
		}
		redirect('setting');
	}

	public function getDocument($id)
	{
		$this->load->model('ModelDocument');
		$data = $this->ModelDocument->getList($id);
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	} 



	public function addType() 
	{
		$this->load->model('ModelNews');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$adddata = $this->input->post();
			$result = $this->ModelNews->addType($adddata);
			if ($result==1) {
				$this->session->set_userdata('success', 'เพิ่มประเภทข่าวสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}
	}

	public function editType($id)
	{	
		$this->load->model('ModelNews');
		$data = $this->ModelNews->getType($id);

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$update = $this->input->post();
			$result = $this->ModelNews->editType($id, $update);
			if ($result==1) {
				$this->session->set_userdata('success', 'แก้ไขประเภทข่าวสำเร็จ');
			} else {
				$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
			}
			redirect('setting');
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));

	}

	public function deleteType($id) 
	{
		$this->load->model('ModelNews');
		$result = $this->ModelNews->deleteType($id);
		if ($result==1) {
			$this->session->set_userdata('success', 'ลบประเภทข่าวสำเร็จ');
		} else {
			$this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการ');
		}
		redirect('setting');
	}

	public function getType($id) 
	{
		$this->load->model('ModelNews');
		$data = $this->ModelNews->getType($id);

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
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