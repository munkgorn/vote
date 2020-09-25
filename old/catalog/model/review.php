<?php 
	class ReviewModel extends db {
		public function addReview($data=array()){
			$result = array();
			$result = $this->insert('review',$data);
			return $result;
		}
	}
?>