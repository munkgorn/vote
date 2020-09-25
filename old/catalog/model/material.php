<?php 
	class MaterialModel extends db {
		public function listMaterial(){
			$result = array();
			$sql = 'SELECT * FROM sl_material';
			$result_content = $this->query($sql);
			$result = $result_content->rows;
			return $result;
		}
		public function getPrice($data=array()){
			$result = array();
			$sql = 'SELECT * FROM sl_material_take_province WHERE id_material='.(int)$data['id_material'].' AND id_province='.(int)$data['id_province'];
			$result_content = $this->query($sql);
			$result = $result_content->row;
			return $result;
		}
	}
?>