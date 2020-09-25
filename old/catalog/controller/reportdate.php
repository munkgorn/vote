<?php 
	class reportdateController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_report_date');
	    }
	}
?>