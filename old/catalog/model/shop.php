<?php 
	class ShopModel extends db {
		public function getShopDetail($shop_id){
			$result = array();
			$result = $this->query("SELECT * FROM dh_shop WHERE shop_id = '".$shop_id."'")->row;
			return $result;
		}
		public function getShop(){
			$result = array();
			$result = $this->query("SELECT * FROM dh_shop WHERE dh_shop.shop_on = 1")->rows;
			return $result;
		}
	}
?>