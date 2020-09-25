<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
		$this->checkPermission('S01_NEWS');
    }

	public function index($status=null, $message='')
	{
		$data = array();
		$data['base_url'] = base_url();
		$data['heading_title'] = 'จัดการข่าวสาร';
		$data['breadcrumbs'] = array(
			// array('name'=>'หน้าหลัก','link'=>base_url('home')),
			array('name'=>'จัดการข่าวสาร','link'=>base_url('news')),
		);

		$data['status'] = $status;
		$data['message'] = urldecode($message);

		$this->load->model('ModelNews');
		$data['lists'] = array();
		$lists = $this->ModelNews->getLists();
		foreach ($lists as $key => $list) {
			$priority = array(1=>'ด่วน', 'ด่วนมาก', 'ด่วนที่สุด');

			$data['lists'][] = array(
				'id'        => $list->id,
				'no'        => ++$key,
				'name'      => $list->name,
				'type_name' => $list->type_name,
				'priority'  => !empty($priority[$list->priority]) ? $priority[$list->priority] : '',
				'date_show' => $list->date_show,
				'date_end'  => $list->date_end
			);
		}
		$data['action_add'] = base_url('news/add');
		$data['action_edit'] = base_url('news/edit');
		$data['action_del'] = base_url('news/delete');
		$data['news_types'] = $this->ModelNews->getTypes();

		$this->load->view('common/header', $data);
		$this->load->view('common/menu', $data);
		$this->load->view('news/list', $data); 
		$this->load->view('common/footer', $data);
	}

	public function getList() 
	{
		$this->checkLogin();
		$data = array();

		$this->load->model('ModelNews');
		$data = $this->ModelNews->getList($this->input->post('id'));
		$priority = array( 1 => 'ด่วน', 'ด่วนมาก', 'ด่วนที่สุด');

		$data->file = base_url().'uploads/'.$data->file;
		$data->priority = $priority[$data->priority];

		$data->showtime = false;
		$time = time();
		if ($time >= strtotime($data->date_show) && $time <= strtotime($data->date_end)) {
			$data->showtime = true;
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	public function add() 
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$this->load->model('ModelNews');
			$post = $this->input->post();
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
			$post['file'] = $image;
			$post['date_show'] = date('Y-m-d H:i:s', strtotime($post['date_show']) );
			$post['date_end'] = date('Y-m-d H:i:s', strtotime($post['date_end']) );
			$result = $this->ModelNews->add($post);
			if ($result==1) {
				redirect('news/index/1/เพิ่ม ข่าวสาร '.$post['name'].' เรียบร้อยแล้ว');
			} else {
				redirect('news/index/0/ผิดพลาดบางอย่างเกี่ยวกับ เพิ่ม ข่าวสาร '.$post['name']);
			}
		} else {
			redirect('news');
		}
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$this->load->model('ModelNews');

			$post = $this->input->post();

			// Upload
			$image = '';

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
					$upload_data = $this->upload->data();
					$image = $upload_data['file_name'];
				}
			} else if ($_FILES['image']['error']==4) {
				$image = '';
			}
			// Upload
			
			// exit();
			if (!empty($image)) {
				$post['file'] = $image;	
			}
			
			$id = $post['id'];
			unset($post['id']);
			$post['date_show'] = date('Y-m-d H:i:s', strtotime($post['date_show']) );
			$post['date_end'] = date('Y-m-d H:i:s', strtotime($post['date_end']) );
			$result = $this->ModelNews->edit($post, $id);
			if ($result==1) {
				redirect('news/index/1/แก้ไข ข่าวสาร '.$post['name'].' เรียบร้อยแล้ว');
			} else {
				redirect('news/index/0/ผิดพลาดบางอย่างเกี่ยวกับ แก้ไข ข่าวสาร '.$post['name']);
			}
		} else {
			redirect('news');
		}
	}

	public function delete()
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {
			$this->load->model('ModelNews');
			$result = $this->ModelNews->delete($this->input->post('id'));
			if ($result==1) {
				redirect('news/index/1/ลบ ข่าวสาร เรียบร้อยแล้ว');
			} else {
				redirect('news/index/0/ผิดพลาดบางอย่างเกี่ยวกับ ลบ ข่าวสาร');
			}
		} else {
			redirect('news');
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