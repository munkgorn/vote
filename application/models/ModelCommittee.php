<?php  
class ModelCommittee extends CI_Model {

	public $id;
	public $name;

	public function getLists() 
	{
		$query = $this->db->get('committee');
		return $query->result();
	}
	public function getList($id) 
	{	
		$this->db->where('id', $id);
		$query = $this->db->get('committee');
		return $query->row_object();
	}
}