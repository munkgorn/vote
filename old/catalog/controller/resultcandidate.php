<?php 
	class resultcandidateController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_result_candidate');
	    }
	}
?>