<?php 
	class CreatecandidateController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_create_candidate');
	    }
	}
?>