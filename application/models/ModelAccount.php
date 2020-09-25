<?php  
class ModelAccount extends CI_Model {

	public $id;
	public $username;
	public $password;
	public $name;
	public $email;
	public $status;
	public $date_added;
	public $date_modify;

	public function login()
	{
		$this->db->where('username', $this->username);
		$this->db->where('password', $this->password);
		$this->db->where('status', 1);
		$query = $this->db->get('account');
		return $query->row_array();
	}

	public function checkLogin()
	{
		$this->db->where('id', $this->id);
		$this->db->where('username', $this->username);
		$this->db->where('password', $this->password);
		$this->db->where('status', 1);
		$query = $this->db->get('account');
		return $this->db->affected_rows();
	}

}
?>