<?php 
	class MasterModel extends db {
		public function listProvince(){
			$result = array();
			$sql = 'SELECT * FROM sl_province';
			$result_content = $this->query($sql);
			$result = $result_content->rows;
			return $result;
		}
	}
?>