<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->checkLogin();
    }

    public function index()
    {
        $data = array();
        if ($this->session->has_userdata('token')) {
            redirect('home');
        } else {
            $this->login();
        }
    }

    public function checkTimeout()
    {
        $expire_date = $this->session->userdata('expire_date');

        $now = time();
        $timestamp = strtotime($expire_date);
        $diff = ($timestamp - $now);
        $min = floor($diff / 60);
        $sec = ($diff - ($min * 60));

        $diff_time = sprintf('%02d', $min) . ':' . sprintf('%02d', $sec);

        $json = array();
        $json['expire_date'] = $expire_date;
        $json['timeout'] = $now > $timestamp ? true : false;
        $json['now'] = $diff_time;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function login()
    {
        date_default_timezone_set("Asia/Bangkok");
        // echo md5('898988');
        $data = array();
        $data['heading_title'] = 'เข้าสู่ระบบ';
        $data['action'] = base_url('member/login');
        $data['base_url'] = base_url();
        $data['error'] = '';

        $data['success'] = $this->session->has_userdata('success') ? $this->session->success : '';
        $this->session->unset_userdata('success');
        $data['error'] = $this->session->has_userdata('error') ? $this->session->error : '';
        $this->session->unset_userdata('error');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $this->load->model('ModelPermission');
            $login['id_card'] = $this->input->post('id_card');
            $login['member_no'] = $this->input->post('member_no');
            $login['password'] = ($this->input->post('password'));
            $member = $this->ModelMember->login($login);
            // echo $member;exit();
            if (isset($member['id']) && $member['id'] > 0) {

                $permiss = $this->ModelPermission->getMemberToPermission($member['member_type_id']);
                $permission = array();
                foreach ($permiss as $value) {
                    $permission[] = $value->permission_key;
                }
                $this->session->sess_expiration = 5;
                $this->session->set_userdata('permission', $permission);
                $this->session->set_userdata('token', base64_encode(json_encode($member)));

                // TIME LOGIN 5 MIN
                if ($member['member_type_id'] == 1) {
                    $min = 1000;
                }else{
                    $min = 5; // min.
                }
                $expire_date = date('Y-m-d H:i:s', time() + (60 * $min));

                // $this->session->set_userdata('timeout', $min);
                $this->session->set_userdata('expire_date', $expire_date);
                //$this->ModelMember->updateLogin($member['id'], date('Y-m-d H:i:s', time()));

                // check last vote
                $token = $this->session->userdata('token');
                $member = json_decode(base64_decode($token));
                $this->load->model('ModelRecruiting');
                $this->load->model('ModelScore');
                $this->load->model('ModelCandidate');
                $recruitings = $this->ModelRecruiting->getLists();

                $data['recruitings'] = array();
                if (count($recruitings) > 0) {
                    $i = 1;
                    foreach ($recruitings as $key => $value) {
                        $list = array();
                        $list2 = array();
                        if ($value->recruiting_type == 'committee') {
                            $lists_committee = $this->ModelRecruiting->getRecruitingCommittee($value->id);
                            foreach ($lists_committee as $list_committee) {
                                $list2[] = $list_committee->committee_name;
                                $list[] = array(
                                    'name' => $list_committee->committee_name,
                                    'type_id' => $list_committee->type_id,
                                );
                            }
                        }
                        if ($value->recruiting_type == 'members') {
                            $lists_members = $this->ModelRecruiting->getRecruitingMemberGroup($value->id);
                            foreach ($lists_members as $list_member) {
                                // echo $member->member_group_id.' '.$list_member->type_id;
                                // echo '<br>';
                                if ($member->member_group_id == $list_member->type_id) {
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
                        if ((int) $resultScore > 0) {
                            $status = true;
                        }

                        $timevote = false;
                        if (time() >= strtotime($value->date_score_start) && time() <= strtotime($value->date_score_end)) {
                            $timevote = true;
                        }

                        $timevote_text = '';
                        if ($timevote == false) {
                            $timevote_text = 'เวลาลงคะแนน<br>' . date('d-m-Y H:i:s', strtotime($value->date_score_start)) . '<br>ถึง<br>' . date('d-m-Y H:i:s', strtotime($value->date_score_end));
                        }

                        $check = 0;
                        $canvote = true;
                        // check i can vote?
                        if (count($list) > 0 && $status == false) {
                            $data['recruitings'][] = array(
                                'id' => $value->id,
                            );
                        }
                    }
                }
                // check last vote

                $json = array(
                    'message' => 'Login',
                    'member' => $member,
                    'date' => date('Y-m-d H:i:s'),
                );
                $json = json_encode($json);
                log_message('info', $json);

                redirect('Candidate/vote');
            } else {
                $data['error'] = 'ชื่อผู้ใช้งาน หรือ รหัสผ่าน ผิด';
            }
        }

        $this->load->model('ModelNews');
        $data['lists'] = array();
        $lists = $this->ModelNews->getLists();
        foreach ($lists as $key => $list) {
            $priority = array(1 => 'ด่วน', 'ด่วนมาก', 'ด่วนที่สุด');

            $showtime = false;
            $time = time();
            if ($time >= strtotime($list->date_show) && $time <= strtotime($list->date_end)) {
                $showtime = true;
            }

            $data['lists'][] = array(
                'id' => $list->id,
                'no' => ++$key,
                'name' => $list->name,
                'type_name' => $list->type_name,
                'priority' => !empty($priority[$list->priority]) ? $priority[$list->priority] : '',
                'file' => !empty($list->file) ? base_url() . '/uploads/' . $list->file : '',
                'showtime' => $showtime,
                'date_show' => $list->date_show,
                'date_end' => $list->date_end,
            );
        }
        $this->load->view('common/header', $data);
        $this->load->view('member/login', $data);
        $this->load->view('common/footer', $data);
    }

    public function logout()
    {
        $this->session->set_userdata('token', '');
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('expire_date');
        redirect('member/login');
    }

    public function add()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $post = $this->input->post();

            $date = explode('-', $post['birthday']);
            $post['birthday'] = $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';

            $date = explode('-', $post['date_register']);
            $post['date_register'] = $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';

            $result = $this->ModelMember->add($post);
            if ($result == 1) {
                $this->session->set_userdata('success', 'เพิ่ม สมาชิก ' . $post['firstname'] . ' เรียบร้อยแล้ว');
            } else {
                $this->session->set_userdata('error', 'ผิดพลาดบางอย่างเกี่ยวกับ เพิ่ม สมาชิก ' . $post['firstname']);
            }
            redirect('member/all');
        } else {
            redirect('member/all');
        }
    }

    public function edit()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $post = $this->input->post();
            $id = $post['id'];
            unset($post['id']);

            $date = explode('-', $post['birthday']);
            $post['birthday'] = $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';

            $date = explode('-', $post['date_register']);
            $post['date_register'] = $date[2] . '-' . $date[1] . '-' . $date[0] . ' 00:00:00';

            if (!isset($post['password']) || (isset($post['password']) && empty($post['password']))) {
                unset($post['password']);
            } else {
                $post['password'] = ($post['password']);
            }

            $result = $this->ModelMember->edit($post, $id);
            if ($result == 1) {
                $this->session->set_userdata('success', 'แก้ไข สมาชิก เรียบร้อยแล้ว');
            } else {
                $this->session->set_userdata('error', 'ผิดพลาดบางอย่างเกี่ยวกับ แก้ไข สมาชิก');
            }
            redirect('member/all');
        } else {
            redirect('member/all');
        }
    }

    public function delete()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $result = $this->ModelMember->delete($this->input->post('id'));
            if ($result == 1) {
                $this->session->set_userdata('success', 'ลบ สมาชิก เรียบร้อยแล้ว');
            } else {
                $this->session->set_userdata('error', 'ผิดพลาดบางอย่างเกี่ยวกับ ลบ สมาชิก');
            }
        } else {
            redirect('member/all');
        }
    }

    public function all()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        $data = array();
        $data['base_url'] = base_url();
        $data['heading_title'] = 'จัดการสมาชิก';
        $data['breadcrumbs'] = array(
            // array('name'=>'หน้าหลัก','link'=>base_url('home')),
            array('name' => 'จัดการสมาชิก', 'link' => base_url('member/all')),
        );

        $filter = array();
        if ($this->input->get('filter_firstname')) {
            $filter['filter_firstname'] = $this->input->get('filter_firstname');
            $data['filter_firstname'] = $this->input->get('filter_firstname');
        } else {
            $data['filter_firstname'] = '';
        }
        if ($this->input->get('filter_lastname')) {
            $filter['filter_lastname'] = $this->input->get('filter_lastname');
            $data['filter_lastname'] = $this->input->get('filter_lastname');
        } else {
            $data['filter_lastname'] = '';
        }
        if ($this->input->get('filter_member_no')) {
            $filter['filter_member_no'] = $this->input->get('filter_member_no');
            $data['filter_member_no'] = $this->input->get('filter_member_no');
        } else {
            $data['filter_member_no'] = '';
        }

        $url = '';
        $i = 0;
        foreach ($filter as $key => $value) {
            $url .= (!empty($value)) ? (($i == 0 ? '?' : '&') . $key . '=' . $value) : '';
            $i++;
        }

        $this->load->model('ModelMember');
        $data['lists'] = array();
        $filter['start'] = 0;
        $filter['limit'] = 10;
        $lists = $this->ModelMember->getLists($filter);
        if (count($lists) > 0) {
            foreach ($lists as $key => $list) {
                $data['lists'][] = array(
                    'id' => $list->id,
                    'no' => ++$key,
                    'name' => $list->prefix_name . ' ' . $list->firstname . ' ' . $list->lastname,
                    'member_no' => $list->member_no,
                    'member_group_name' => $list->member_group_name,
                    'status' => ($list->status == 1) ? 'ใช้งาน' : 'ไม่ใช้งาน',
                );
            }
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

        $data['action_add'] = base_url('member/add');
        $data['action_edit'] = base_url('member/edit');
        $data['action_del'] = base_url('member/delete');
        $data['action_search'] = base_url('member/all' . $url);
        $data['action_import'] = base_url('member/importCSV');
        $data['member_groups'] = $this->ModelMember->getGroups();
        $data['member_types'] = $this->ModelMember->getTypes();

        $data['export'] = base_url('member/exportCSV' . $url);
        $data['export_all'] = base_url('member/exportCSV');

        $this->load->view('common/header', $data);
        $this->load->view('common/menu', $data);
        $this->load->view('member/list', $data);
        $this->load->view('common/footer', $data);
    }

    public function getLists()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        $this->load->model('ModelMember');
        $data = array();

        $filter = array();

        if ($this->input->post('filter_firstname')) {
            $filter['filter_firstname'] = $this->input->post('filter_firstname');
            $data['filter_firstname'] = $this->input->post('filter_firstname');
        } else {
            $data['filter_firstname'] = '';
        }
        if ($this->input->post('filter_lastname')) {
            $filter['filter_lastname'] = $this->input->post('filter_lastname');
            $data['filter_lastname'] = $this->input->post('filter_lastname');
        } else {
            $data['filter_lastname'] = '';
        }
        if ($this->input->post('filter_member_no')) {
            $filter['filter_member_no'] = $this->input->post('filter_member_no');
            $data['filter_member_no'] = $this->input->post('filter_member_no');
        } else {
            $data['filter_member_no'] = '';
        }

        $listsall = $this->ModelMember->getLists($filter);

        if ($this->input->post('start')) {
            $filter['start'] = $this->input->post('start');
        } else {
            $filter['start'] = 0;
        }
        if ($this->input->post('length')) {
            $filter['limit'] = $this->input->post('length');
        } else {
            $filter['limit'] = 10;
        }

        $data['data'] = array();
        $lists = $this->ModelMember->getLists($filter);
        if (count($lists) > 0) {
            foreach ($lists as $key => $list) {
                $action = '<button class="btn btn-warning" data-toggle="modal" data-target="#edit" data-id="' . $list->id . '"><i class="fa fa-edit"></i></button>';
                $action .= '<button class="btn btn-default" data-toggle="modal" data-target="#view" data-id="' . $list->id . '"><i class="fa fa-eye"></i></button>';
                $action .= '<button class="btn btn-danger" data-toggle="modal" data-target="#Modal3"><i class="fa fa-key"></i></button>';

                $data['data'][] = array(
                    'id' => $list->id,
                    'id_card' => $list->id_card,
                    'no' => ++$key,
                    'name' => $list->prefix_name . ' ' . $list->firstname . ' ' . $list->lastname,
                    'member_no' => $list->member_no,
                    'member_group_name' => $list->member_group_name,
                    'status' => ($list->status == 1) ? 'ใช้งาน' : 'ไม่ใช้งาน',
                    'action' => $action,
                );
            }
        }

        $data['draw'] = $this->input->post('draw');
        $data['recordsTotal'] = $this->input->post('length');
        $data['recordsFiltered'] = count($listsall);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function getList()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        $data = array();

        $this->load->model('ModelMember');
        $data = $this->ModelMember->getList($this->input->post('id'));

        $data->birthday = isset($data->birthday) && !empty($data->birthday) ? date('d-m-Y', strtotime($data->birthday)) : '';
        $data->age = isset($data->birthday) && !empty($data->birthday) ? date('Y', time()) - date('Y', strtotime($data->birthday)) : '';
        $data->date_register = isset($data->date_register) && !empty($data->date_register) ? date('d-m-Y', strtotime($data->date_register)) : '';
        $data->status = $data->status == 1;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function type()
    {
        $this->checkLogin();
        $this->checkPermission('S10_ROLE');

        $data = array();
        $data['base_url'] = base_url();
        $data['heading_title'] = 'ตั้งค่าประเภทผู้ใช้ระบบ';
        $data['breadcrumbs'] = array(
            // array('name'=>'หน้าหลัก','link'=>base_url('home')),
            array('name' => 'ตั้งค่าประเภทผู้ใช้ระบบ', 'link' => base_url('member/type')),
        );

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

        $this->load->model('ModelMember');
        $data['types'] = array();
        $types = $this->ModelMember->getTypes();
        foreach ($types as $key => $type) {
            $data['types'][] = array(
                'no' => ++$key,
                'name' => $type->name,
                'id' => $type->id,
            );
        }

        $data['action_add'] = base_url('member/typeadd');
        $data['action_del'] = base_url('member/typedelete/');

        $this->load->view('common/header', $data);
        $this->load->view('common/menu', $data);
        $this->load->view('member/type', $data);
        $this->load->view('common/footer', $data);

    }

    public function typeadd()
    {
        $this->checkLogin();
        $this->checkPermission('S10_ROLE');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $post = $this->input->post();

            $result = $this->ModelMember->addtype($post);
            if ($result == 1) {
                $this->session->set_userdata('success', 'เพิ่มประเภทผู้ใช้งาน เรียบร้อยแล้ว');
            } else {
                $this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการเกี่ยวกับ ประเภทผู้ใช้งาน');
            }
        } else {
            redirect('member/type');
        }
    }

    public function typedelete($id)
    {
        $this->checkLogin();
        $this->checkPermission('S10_ROLE');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->model('ModelMember');
            $result = $this->ModelMember->deleteType($id);
            if ($result == 1) {
                $this->session->set_userdata('success', 'ลบประเภทผู้ใช้งาน เรียบร้อยแล้ว');
            } else {
                $this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการเกี่ยวกับ การลบประเภทผู้ใช้งาน  ผิดพลาด');
            }
        }
        redirect('member/type');
    }

    public function password()
    {
        $this->checkLogin();
        $this->checkPermission('S09_CHANGE_PASSWORD');
        $data = array();
        $data['base_url'] = base_url();
        $data['heading_title'] = 'เปลี่ยนรหัสผ่าน';
        $data['breadcrumbs'] = array(
            // array('name'=>'หน้าหลัก','link'=>base_url('home')),
            array('name' => 'เปลี่ยนรหัสผ่าน', 'link' => base_url('member/password')),
        );

        $this->load->model('ModelMember');
        $token = json_decode(base64_decode($this->session->userdata('token')));

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($this->input->post('oldpassword') == $this->input->post('password')) {
                $this->session->set_userdata('error', 'รหัสผ่านเก่า ไม่ควรเหมือน รหัสผ่านใหม่');
            } else if ($this->input->post('password') != $this->input->post('confirmpassword')) {
                $this->session->set_userdata('error', 'รหัสผ่านใหม่ไม่ตรงกัน');
            } else if ($this->input->post('password') == $this->input->post('confirmpassword')) {
                $post = array();
                $post['oldpassword'] = md5($this->input->post('oldpassword'));
                $post['password'] = md5($this->input->post('password'));

                $result = $this->ModelMember->changepassword($token->id, $post);

                if ($result == 1) {
                    $member = $this->ModelMember->getList($token->id);
                    $this->session->set_userdata('token', base64_encode(json_encode($member)));

                    $this->session->set_userdata('success', 'แก้ไขรหัสผ่าน เรียบร้อยแล้ว');
                } else {
                    $this->session->set_userdata('error', 'เกิดข้อผิดพลาดบางประการเกี่ยวกับ แก้ไขรหัสผ่าน');
                }
            }
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

        $member_info = $this->ModelMember->getList($token->id);
        $data['user'] = $member_info->id_card . '@' . $member_info->member_no;
        $data['action'] = base_url('member/password');

        $this->load->view('common/header', $data);
        $this->load->view('common/menu', $data);
        $this->load->view('member/password', $data);
        $this->load->view('common/footer', $data);
    }

    public function importCSV()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $fileimport = '';
            // upload
            if ($_FILES['importfile']['error'] == 0) {
                $config['upload_path'] = './uploads/import_member/';
                $config['allowed_types'] = 'csv';
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('importfile')) {
                    // $this->error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('error', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ ' . $this->upload->display_errors());
                } else {
                    $upload_data = $this->upload->data();
                    $fileimport = $upload_data['file_name'];
                } 
            } else {
                $this->session->set_userdata('error', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์');
                echo '<script>alert("File Import Error");</script>';
            }
            // upload

            if (!empty($fileimport)) { 

                $file = 'uploads/import_member/' . $fileimport;
                $this->load->model('ModelMember');
                $result = $this->ModelMember->importCSV($file);

                $this->session->set_userdata('success', 'อัพโหลดไฟล์เรียบร้อยแล้ว');

                echo '<script>alert("Import : ' . $result . ' rows");</script>';
                // $row = 1;
                // if (($handle = fopen("uploads/import_member/".$fileimport,"r")) !== FALSE) {
                //     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                //         $num = count($data);
                //         if ($row>1) {
                //             $newdata[] = array(
                //                 'member_no'   => $data[0],
                //                 'prefix_name' => $data[1],
                //                 'firstname'   => $data[2],
                //                 'lastname'    => $data[3],
                //                 'id_card'     => $data[4],
                //                 'password'    => $data[5],
                //                 'member_group'  => $data[6],
                //                 'phone'       => $data[7]
                //             );
                //         }
                //         $row++;
                //     }
                //     fclose($handle);

                //     $this->load->model('ModelMember');
                //     $result = $this->ModelMember->importCSV($newdata);
                //     if ($result==true) {
                //         $this->session->set_userdata('success', 'Import ข้อมูลสมาชิกเรียบร้อยแล้ว กรุณาแก้ไขข้อมูลเพิ่มเติม');
                //     } else {
                //         $this->session->set_userdata('error', 'เกิดข้อผิดพลาด Import ข้อมูลสมาชิก');
                //     }

                // }

            } else {
                $this->session->set_userdata('error', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ ไม่พบไฟล์');
                // echo '<script>alert("Not Found file import");</script>';
            }
        } else {
            $this->session->set_userdata('error', 'ไม่พบ');
        }

        redirect('member/all');
    }

    public function exportCSV()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        $filename = 'ExportMember' . date('Ymd') . '.csv';
        header('Content-Encoding: UTF-8');
        header("Content-type: text/csv; charset=utf-8");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=" . $filename);

        // utf-8 bom
        echo "\xEF\xBB\xBF";
        // get data

        $filter = array();
        if ($this->input->get('filter_firstname')) {
            $filter['filter_firstname'] = $this->input->get('filter_firstname');
            $data['filter_firstname'] = $this->input->get('filter_firstname');
        } else {
            $data['filter_firstname'] = '';
        }
        if ($this->input->get('filter_lastname')) {
            $filter['filter_lastname'] = $this->input->get('filter_lastname');
            $data['filter_lastname'] = $this->input->get('filter_lastname');
        } else {
            $data['filter_lastname'] = '';
        }
        if ($this->input->get('filter_member_no')) {
            $filter['filter_member_no'] = $this->input->get('filter_member_no');
            $data['filter_member_no'] = $this->input->get('filter_member_no');
        } else {
            $data['filter_member_no'] = '';
        }

        $this->load->model('ModelMember');
        $this->ModelMember->exportCSV($filter); // echo in model
        exit();
    }

    public function importGroupCSV()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $fileimport = '';
            // upload
            if ($_FILES['importfile']['error'] == 0) {
                $config['upload_path'] = './uploads/import_membergroup/';
                $config['allowed_types'] = 'csv';
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('importfile')) {
                    // $this->error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('error', 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ ' . $this->upload->display_errors());
                } else {
                    $upload_data = $this->upload->data();
                    $fileimport = $upload_data['file_name'];
                }
            }
            // upload

            if (!empty($fileimport)) {

                $file = 'uploads/import_membergroup/' . $fileimport;
                $this->load->model('ModelMember');
                $this->load->model('ModelRecruiting');
                // $result = $this->ModelMember->importGroupCSV($file);
                $row = 1;
                if (($handle = fopen($file, "r")) !== false) {

                    $token = $this->session->userdata('token');
                    $member = json_decode(base64_decode($token));

                    $insert['members'] = array();
                    $members = array();
                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        $num = count($data);

                        if ($row == 1) {
                            $insert['set'] = $data[1];
                        }
                        if ($row == 2) {
                            $insert['year'] = $data[1];
                        }
                        if ($row == 1) {
                            $insert['no'] = $data[1];
                        }
                        if ($row > 5) {
                            if ($data[3] > 0 && $data[4] >= 0) {
                                $members['receiving'][$data[0]] = $data[3];
                                $members['reserve'][$data[0]] = $data[4];
                            }
                        }
                        $row++;
                    }

                    $insert['members'] = $members;

                    $insert['recruiting_type'] = 'members';
                    $insert['member_id'] = $member->id;

                    $insert['date_register_start'] = date('Y-m-d H:i:s', time());
                    $insert['date_register_end'] = date('Y-m-d H:i:s', time());

                    $insert['date_score_start'] = date('Y-m-d H:i:s', time());
                    $insert['date_score_end'] = date('Y-m-d H:i:s', time());

                    $insert['status'] = 0;
                    $insert['del'] = 0;

                    $recruiting_id = $this->ModelRecruiting->add($insert);

                    fclose($handle);
                    if ($recruiting_id > 0) {
                        redirect('Candidate/Add/' . $recruiting_id);
                        exit();
                    }
                }

            }
        }

        redirect('recruiting');
    }

    public function exportGroupCSV()
    {
        $this->checkLogin();
        $this->checkPermission('S02_USER');
        $filename = 'Export วาระการสรรหาผู้แทนสมาชิก ' . date('Ymd') . '.csv';
        header('Content-Encoding: UTF-8');
        header("Content-type: text/csv; charset=utf-8");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=" . $filename);

        // utf-8 bom
        echo "\xEF\xBB\xBF";
        // get data

        $this->load->model('ModelMember');
        $this->ModelMember->exportGroupCSV(); // echo in model
        exit();
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

    public function updateMemberNo()
    {

        $this->load->model('ModelMember');
        $members = $this->ModelMember->getLists();
        foreach ($members as $member) {
            // print_r($member->member_no);
            if (strlen($member->member_no) != 6) {
                // echo $member->member_no;
                // echo '<br>';
                // echo $member->id.' ';
                $edit['member_no'] = sprintf('%06d', (int) $member->member_no);
                $this->ModelMember->edit($edit, $member->id);
            }

        }

    }

    public function updateMember()
    {
        $this->load->model('ModelMember');

        require_once dirname(__FILE__) . '/../../assets/PHPExcel-1.8/Classes/PHPExcel.php';
        $inputFileName = 'uploads/import_member/fiximportmember.xlsx';
        // Read Excel
        $page = 0;

        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);

        $objWorksheet = $objPHPExcel->setActiveSheetIndex($page);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
        $headingsArray = $headingsArray[1];
        $r = -1;
        $namedDataArray = array();
        $address = array();
        for ($row = 0; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
            ++$r;
            foreach ($headingsArray as $columnKey => $columnHeading) {
                $namedDataArray[$r][] = $dataRow[$row][$columnKey];
            }
        }
        // Read Excel

        $row = 0;
        $i = 0;
        if (count($namedDataArray) > 0) {
            foreach ($namedDataArray as $value) {
                if (!empty($value[0]) && $value[0] != 'ลำดับที่' && !empty($value[1]) && !empty($value[2]) && !empty($value[3]) && !empty($value[4]) && !empty($value[5]) && !empty($value[6]) && !empty($value[7]) && !empty($value[8])) {
                    $insert = array();
                    $insert['member_group_id'] = 0;
                    $insert['member_type_id'] = 3;
                    $insert['temp_member_group'] = '';
                    $insert['temp_member_group_code'] = '';
                    $insert['id_card'] = '';
                    $insert['member_no'] = '';
                    $insert['password'] = '';
                    $insert['prefix_name'] = '';
                    $insert['firstname'] = '';
                    $insert['lastname'] = '';
                    $insert['email'] = '';
                    $insert['birthday'] = '';
                    $insert['date_register'] = '';
                    $insert['phone'] = '';
                    $insert['status'] = 1;
                    $insert['date_added'] = '2019-12-09 00;00:00';
                    $insert['date_modify'] = '2019-12-09 00:00:00';
                    $insert['del'] = 0;
                    // echo '<pre>';
                    // print_r($value);
                    // echo '</pre>';
                    $i++;
                }
                $row++;
            }
            echo $i;
        }

    }

    public function updateMemberGroup()
    {
        $this->load->model('ModelMember');
        // $this->Mod

        require_once dirname(__FILE__) . '/../../assets/PHPExcel-1.8/Classes/PHPExcel.php';
        $inputFileName = 'uploads/import_membergroup/fiximportmembergroup2.xlsx';
        // Read Excel
        $page = 0;

        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);

        $objWorksheet = $objPHPExcel->setActiveSheetIndex($page);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
        $headingsArray = $headingsArray[1];
        $r = -1;
        $namedDataArray = array();
        $address = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
            if ((isset($dataRow[$row]['K'])) && ($dataRow[$row]['K'] > '')) {
                ++$r;
                foreach ($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][] = $dataRow[$row][$columnKey];
                }
            }
        }
        // Read Excel

        if (count($namedDataArray) > 0) {
            foreach ($namedDataArray as $value) {
                $insert = array();
                $insert['region_id'] = 1;
                $insert['code'] = sprintf('%06d', $value[1]);
                $insert['name'] = $value[0];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 6;
                $insert['code'] = sprintf('%06d', $value[3]);
                $insert['name'] = $value[2];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 5;
                $insert['code'] = sprintf('%06d', $value[5]);
                $insert['name'] = $value[4];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 3;
                $insert['code'] = sprintf('%06d', $value[7]);
                $insert['name'] = $value[6];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 7;
                $insert['code'] = sprintf('%06d', $value[9]);
                $insert['name'] = $value[8];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 4;
                $insert['code'] = sprintf('%06d', $value[11]);
                $insert['name'] = $value[10];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                $insert = array();
                $insert['region_id'] = 2;
                $insert['code'] = sprintf('%06d', $value[13]);
                $insert['name'] = $value[12];
                if (!empty($insert['name'])) {
                    print_r($insert);
                    echo $this->ModelMember->addGroup($insert);
                    echo '<br>';
                }

                // echo '<pre>';
                // print_r($value);
                // echo '</pre>';
                // echo '<hr>';
            }
        }
    }
}
