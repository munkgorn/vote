<?php 
	class RegisterModel extends db {
		public function register($data=array()){
			$result = array();
			$insert_register = $data;
			unset($insert_register['family_full_name'],$insert_register['family_relation'],$insert_register['family_age'],$insert_register['family_occupation'],$insert_register['emergency_name'],$insert_register['emergency_relationship'],$insert_register['emergency_age'],$insert_register['emergency_occupation'],$insert_register['employment_company_name'],$insert_register['employment_leave_year'],$insert_register['employment_leave_month'],$insert_register['employment_join_year'],$insert_register['employment_join_month']);

			$result_last_insert_register = $this->insert('register',$insert_register);
			
			foreach($data['family_full_name'] as $key => $val){
				if(!empty($val)){
					$insert_family = array(
						'id_register' 	=> $result_last_insert_register,
						'full_name' 	=> $val,
						'relationship' 	=> $data['family_relation'][$key],
						'age' 			=> $data['family_age'][$key],
						'occupation' 	=> $data['family_occupation'][$key]
					);
					$this->insert('register_family',$insert_family);
				}
			}
			foreach($data['emergency_name'] as $key => $val){
				$insert_register_emergency = array(
					'id_register' 	=> $result_last_insert_register,
					'full_name' 	=> $val,
					'relationship' 	=> $data['emergency_relationship'][$key],
					'age' 			=> $data['emergency_age'][$key],
					'occupation' 	=> $data['emergency_occupation'][$key]
				);
				$this->insert('register_emergency',$insert_register_emergency);
			}
			foreach($data['employment_company_name'] as $key => $val){
				$insert_register_employment = array(
					'id_register' 	=> $result_last_insert_register,
					'company_name' 	=> $val,
					'leaving_year' 	=> $data['employment_leave_year'][$key],
					'leaving_month' => $data['employment_leave_month'][$key],
					'joining_year' 	=> $data['employment_join_year'][$key],
					'joining_month' => $data['employment_join_month'][$key]
				);
				$this->insert('register_employment',$insert_register_employment);
			}
			$result['id']		=	$result_last_insert_register;
			$result['encrypt'] 	=	base64_encode($result_last_insert_register);
			return $result;
		}
		public function getRegister($data=array()){
			$result = array();
			$id = base64_decode($data['encrypt']);
			$result['data_register'] = $this->query('SELECT * FROM sl_register WHERE id_register = '.$id)->row;
			$result['data_register_emergency'] = $this->query('SELECT * FROM sl_register_emergency WHERE id_register = '.$id)->rows;
			$result['data_register_employment'] = $this->query('SELECT * FROM sl_register_employment WHERE id_register = '.$id)->rows;
			$result['data_register_family'] = $this->query('SELECT * FROM sl_register_family WHERE id_register = '.$id)->rows;
			return $result;
		}
	}
?>