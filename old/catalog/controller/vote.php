<?php 
	class voteController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_vote');
	    }
	}
?>