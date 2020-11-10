<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index() 
	{
		$data = array();
		$data['heading_title'] = 'Admin System';
		$data['base_url'] = base_url();
        $data['action'] = base_url();
        
		$data['link_empty'] = base_url('admin/emptyMember');


		$this->load->view('common/header', $data);
		// $this->load->view('common/menu', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('common/footer', $data);
    }

    public function emptyMember() {
        
		$this->load->model('ModelMember');
        echo $result = $this->ModelMember->emptyAll();



    }
}