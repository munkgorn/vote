<?php 
	class listcandidateController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_list_candidate');
	    }
	}
?>