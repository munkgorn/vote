<?php  
class ModelPermission extends CI_Model {

	public function getPermission($key) 
	{
		$this->db->where('key', $key);
		$query = $this->db->get('permission');
		return $query->row_object();
	}

	public function getPermissions()
	{
		$this->db->cache_on();
		$query = $this->db->get('permission');
		return $query->result();
	}

	public function editPermission($member_type_id, $data)
	{
		if (count($data)>0) {
			$query = $this->db->get('permission');
			foreach ($query->result() as $value) {

				$this->db->where('member_type_id', $member_type_id);
				$this->db->where('permission_id', $value->id);
				$query = $this->db->get('member_to_permission');

				if ($this->db->affected_rows()==1) {
					$update['member_type_id'] = $member_type_id;
					$update['permission_id'] = $value->id;
					$update['status'] = array_key_exists($value->id, $data) ? 1 : 0;
					$this->db->where('member_type_id', $member_type_id);
					$this->db->where('permission_id', $value->id);
					$this->db->update('member_to_permission', $update);	
				} else {
					$insert['member_type_id'] = $member_type_id;
					$insert['permission_id'] = $value->id;
					$insert['status'] = array_key_exists($value->id, $data) ? 1 : 0;
					$this->db->insert('member_to_permission', $insert);	
				}
			}
		}
	}

	public function getMemberToPermission($member_type_id) 
	{	
		$this->db->select('member_to_permission.*, permission.name as permission_name, permission.key as permission_key');
		$this->db->where('member_to_permission.member_type_id', $member_type_id);
		$this->db->where('member_to_permission.status', 1);
		$this->db->join('permission' , 'permission.id = member_to_permission.permission_id');
		$query = $this->db->get('member_to_permission');
		return $query->result();
	}

	public function checkPermission($member_type_id, $permission_id) 
	{	
		$this->db->where('member_type_id', $member_type_id);
		$this->db->where('permission_id', $permission_id);
		$this->db->where('status', 1);
		$query = $this->db->get('member_to_permission');
		return $this->db->affected_rows();
	}
}
?>