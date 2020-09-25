<?php 
	class changepassController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_change_pass');
	    }
	}
?>