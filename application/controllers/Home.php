<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
    }	

	public function index()
	{
		$this->checkLogin();

		$data = array();
		$data['heading_title'] = 'หน้าหลัก';
		$data['breadcrumbs'] = array(
			array('name'=>'หน้าหลัก','url'=>base_url('home'))
		);
		$data['base_url'] = base_url();

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('common/home', $data); 
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
		}
	}

}