<?php 
	class GirlModel extends db {
		public function getGirlById($no_girl=0){
			$result = array();
			$result = $this->query("SELECT * FROM dh_girls WHERE girls_no = '".(int)trim($no_girl)."'")->row;
			return $result;
		}
		public function getGirlByPhone($girls_phone=0){
			$result = array();
			$result = $this->query("SELECT * FROM dh_girls WHERE girls_phone = '".trim($girls_phone)."'")->row;
			return $result;
		}
		public function getGirlWoringByshop($shop_id){
			$result = array();
			// $result = $this->query("SELECT * FROM dh_shop 
			// 	INNER JOIN dh_girls ON dh_girls.girls_id = dh_data.data_id 
			// 	INNER JOIN dh_data  ON dh_data.data_work_shop = dh_shop.shop_id 
			// 	WHERE dh_shop.shop_id = '".(int)$shop_id."' 
			// 	AND dh_shop.shop_on = 1 AND dh_data.data_work_time BETWEEN ".CONFIG_START_DATE." AND ".CONFIG_END_DATE."
			// ")->rows;
			echo "SELECT * FROM dh_shop 
				INNER JOIN dh_girls ON dh_girls.girls_id = dh_data.data_id 
				INNER JOIN dh_data  ON dh_data.data_work_shop = dh_shop.shop_id 
				WHERE dh_shop.shop_id = '".(int)$shop_id."' 
				AND dh_shop.shop_on = 1 AND dh_data.data_work_time BETWEEN ".CONFIG_START_DATE." AND ".CONFIG_END_DATE."
			";
			return $result;
		}
		
	}
?>