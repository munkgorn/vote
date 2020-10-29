<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index()
	{
		$data = array();
		if ($this->session->has_userdata('token')) {
			redirect('home');
		} else {	
			$this->login();
		}
	}

	public function login() 
	{
		redirect('member/login');
		exit();
		$data = array();
		$data['heading_title'] = 'เข้าสู่ระบบ';
		$data['action'] = base_url('account/login');
		$data['base_url'] = base_url();
		$data['error'] = '';

		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$this->load->model('ModelAccount');
			$this->ModelAccount->username = $this->input->post('username');
			$this->ModelAccount->password = md5($this->input->post('password'));
			$member = $this->ModelAccount->login();
			if (isset($member['id']) && $member['id']>0) {
				$this->session->set_userdata('token', base64_encode(json_encode($member)));
				redirect('home');
			} else {
				$data['error'] = 'ชื่อผู้ใช้งาน หรือ รหัสผ่าน ผิด';
			}
		}

		$this->load->view('common/header', $data);
		// $this->load->view('common/menu', $data);
		$this->load->view('account/login', $data);
		$this->load->view('common/footer', $data);
	}

	public function logout() 
	{
		$this->session->set_userdata('token', '');
		$this->session->unset_userdata('token');
		redirect('account/login');
	}


}