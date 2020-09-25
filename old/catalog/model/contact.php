<?php 
	class ContactModel extends db {
		public function addContact($data=array()){
			$result = array();
			$result_content = $this->insert('contact',$data);
			$result = $result_content;
			return $result;
		}
	}
?>