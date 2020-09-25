<?php 
	class UserModel extends db {
		public function getAllUser(){
			$result = array();
			$result = $this->query('SELECT * FROM sl_user')->rows;
			return $result;
		}
	}
?>