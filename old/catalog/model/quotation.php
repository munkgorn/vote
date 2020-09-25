<?php 
	class QuotationModel extends db {
		public function getQuotation($data=array()){
			$result = array();
			if(isset($data['id_quotation'])){
				$sql_quotation = $this->query('SELECT * FROM sl_quotation WHERE id_quotation='.(int)$data['id_quotation'])->row;
				$sql_quotation_list = $this->query('SELECT * FROM sl_quotation_list WHERE id_quotation='.(int)$data['id_quotation'])->rows;
				$result = $sql_quotation;
				$result['list'] = $sql_quotation_list;
			}
			return $result;
		}
		public function addQuotation($data=array()){
			$result = array();
			$list = $data['list'];
			$insert_data = $data;
			unset($insert_data['list']);
			$insert_data['quotation_datecreate'] = date('Y-m-d H:i:s');
			$insert_data['quo_total'] = str_replace(',', '', $insert_data['quo_total']);
			// $insert_data['quo_vat_total'] = str_replace(',', '', $insert_data['quo_vat_total']);
			$insert_data['quo_net_total'] = str_replace(',', '', $insert_data['quo_net_total']);
			$result_insert_id = $this->insert('quotation',$insert_data);
			foreach($list as $val){
				$val['id_quotation'] = $result_insert_id;
				$val['list_price'] = str_replace(',', '', $val['list_price']);
				$val['list_total_price'] = str_replace(',', '', $val['list_total_price']);
				$result_list = $this->insert('quotation_list',$val);
			}
			$result = array(
				'result'=>'success',
				'id_quotation' => $result_insert_id
			);
			return $result;
		}
	}
?>