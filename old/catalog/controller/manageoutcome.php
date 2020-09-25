<?php 
	class manageoutcomeController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_manage_outcome');
	    }
	}
?>