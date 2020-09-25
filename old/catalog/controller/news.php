<?php 
	class NewsController extends Controller {
	    public function index($data=array()) {
	    	$data = array();
	    	$this->view('cp_news');
	    }
	}
?>