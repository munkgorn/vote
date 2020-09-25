<?php 
	class userpermissionController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_user_permission');
	    }
	}
?>