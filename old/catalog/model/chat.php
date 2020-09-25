<?php 
	class ChatModel extends db {
		public function openChat($data=array()){
			$result = array();
			$result_chat = $this->query('SELECT * FROM sl_chat WHERE id_member='.(int)$data['id_member'].' AND id_member_talk='.(int)$data['id_member_talk']);
			if($result_chat->num_rows == 0){
				if(!empty((int)$data['id_member_talk'])){
					$result_room = $this->insert('chat_room',array('chat_room_datecreated'=>date('Y-m-d H:i:s')));
					$insert_chat = array(
						'id_member' => $data['id_member'],
						'id_member_talk' => (int)$data['id_member_talk'],
						'id_chat_room'=>$result_room,
						'chat_datecreate' => date('Y-m-d H:i:s')
					);
					$result = $this->insert('chat',$insert_chat);
					$insert_chat = array(
						'id_member' => (int)$data['id_member_talk'],
						'id_member_talk' => $data['id_member'],
						'id_chat_room'=>$result_room,
						'chat_datecreate' => date('Y-m-d H:i:s')
					);
					$result = $this->insert('chat',$insert_chat);
				}
			}
			return $result;
		}
		public function listChatRoom($data=array()){
			$result = array();
			$sql = 'SELECT * FROM sl_chat INNER JOIN sl_member ON sl_chat.id_member_talk = sl_member.id_member WHERE sl_chat.id_member='.$data['id_member'];
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function listMsgChatroom($data=array()){
			$result = array();
			$sql = 'SELECT * FROM sl_chat_message WHERE id_chat_room='.$data['id_chat_room'];
			$result = $this->query($sql)->rows;
			return $result;
		}
		public function insertMsg($data = array()){
			$result = array();
			$insert_chat = array(
				'id_member' => $data['id_member'],
	    		'id_chat_room' => $data['id_chat_room'],
	    		'chat_message' => $data['msg'],
	    		'chat_read' => 0,
	    		'chat_datecreate' =>date('T-m-d H:i:s')
			);
			$result = $this->insert('chat_message',$insert_chat);
			$sql_user = 'SELECT * FROM sl_chat WHERE sl_chat.id_member='.$data['id_member'];
			$result_user = $this->query($sql_user)->row;
			$this->query('UPDATE sl_member SET member_notification = member_notification+1 WHERE id_member='.$result_user['id_member_talk']);
			return $result;
		}
		public function getRowsChat($data=array()){
			$result = array();
			$sql = 'SELECT * FROM sl_chat_message WHERE id_chat_room='.$data['id_chat_room'];
			$result = $this->query($sql)->num_rows;
			return $result;
		}
		
	}
?>