<?php 
	class MemberModel extends db {
		public function register($data=array()){
			$result = array();
			$sql = "SELECT * FROM sl_member WHERE member_email='".$this->escape($data['email'])."'";
			$result_check_email = $this->query($sql);
			if($result_check_email->num_rows > 0){
				$result['result'] = 'fail';
				$result['detail'] = 'Dupplicate E-mail';
			}else{
				$insert_data = array(
					'member_name' => $data['name'],
					'member_lname'=> $data['lname'],
					'member_email'=> $data['email'],
					'member_password'=> md5($data['password']),
					'member_phone'=> $data['phone'],
					'id_member_type'=>(int)$data['type_member'],
					'member_created'=>date('Y-m-d H:i:s')
				);
				$insert_member = $this->insert('member',$insert_data);
				if($insert_member){
					$result = array(
						'result' => 'success',
						'detail' => '',
						'id_member'=>$insert_member
					);
				}
			}
			return $result;
		}
		public function login($data = array()){
			$result = array();
			$sql = "SELECT * FROM sl_member WHERE member_email='".$this->escape($data['email'])."' AND member_password='".$this->escape(md5($data['password']))."'";
			
			$result_member = $this->query($sql);
			if($result_member->num_rows > 0){
				$result = array(
					'result' => 'success',
					'detail' => '',
					'member_detail'=>$result_member->row
				);
			}else{
				$result['result'] = 'fail';
				$result['detail'] = 'E-mail or password wrong';
			}
			return $result;
		}
		public function getMemberDetail($id_member){
			$result = array();
			$sql = "SELECT * FROM sl_member WHERE id_member='".(int)$id_member."'";
			$result_member = $this->query($sql);
			if($result_member->num_rows > 0){
				$result = array(
					'result' => 'success',
					'detail' => '',
					'member_detail'=>$result_member->row
				);
			}else{
				$result['result'] = 'fail';
				$result['detail'] = 'Not found';
			}
			return $result;
		}
		public function updateProfile($data=array()){
			$result = array();
			$result_update = $this->update('member',$data,'id_member='.$data['id_member']);
			return $result;
		}
		public function updateCategory($data=array()){
			$result = array();
			if($data['checked']==0){
				$result_delete = $this->delete('take_member_content','id_member='.$data['id_member'].' AND id_content='.$data['id_content']);
			}else{
				$data_insert = array(
					'id_content'=>$data['id_content'],
					'id_member'=>$data['id_member']
				);
				$result_insert = $this->insert('take_member_content',$data_insert);
			}
			return $result;
		}
		public function getCategory($data=array()){
			$result = array();
			$sql = "SELECT * FROM sl_take_member_content WHERE id_member='".(int)$id_member."'";
			$result_member = $this->query($sql);
			if($result_member->num_rows > 0){
				$result = array(
					'result' => 'success',
					'detail' => '',
					'member_detail'=>$result_member->rows
				);
			}
		}
		public function getReview($data=array()){
			$result = array();
			$sql = "SELECT * 
			FROM sl_review
			LEFT JOIN sl_user ON sl_review.id_member_give = sl_user.id_user 
			INNER JOIN sl_language_content ON sl_review.id_content = sl_language_content.id_content
			WHERE id_member = ".(int)$data['id_member']." AND sl_language_content.id_language=2";
			$result_review = $this->query($sql);
			$result = $result_review->rows;
			return $result;
		}
		public function uploadFile($data=array()){
			$result = array();
			$this->insert('member_gallery',$data);
			return $result;
		}
		public function getGallery($data=array()){
			$result = array();
			$sql_gallery = "SELECT * FROM sl_content WHERE id_category=2";
			$result_sql_gallery = $this->query($sql_gallery)->rows;
			foreach($result_sql_gallery as $val){
				$sql = "SELECT * FROM sl_member_gallery WHERE id_content = ".(int)$val['id_content']." AND id_member=".$data['id_member'];
				$result[$val['id_content']] = $this->query($sql)->rows;
			}
			return $result;
		}
		public function getRowNoti($data=array()){
			$result= array();
			$sql = 'SELECT sl_member.member_notification FROM sl_member WHERE id_member='.$data['id_member'];
			$result = $this->query($sql)->num_rows;
			return $result;
		}
	}
?>