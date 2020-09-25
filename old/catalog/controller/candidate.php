<?php 
	class CandidateController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_candidate');
	    }
	}
?>