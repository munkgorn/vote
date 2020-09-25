<?php  
class ModelDocument extends CI_Model {

	public $id;
	public $name;

	public function getLists() 
	{
		$this->db->where('del',0);
		$query = $this->db->get('document');
		return $query->result();
	}

	public function getList($id)
	{
		$this->db->where('del',0);
		$this->db->where('id', $id);
		$query = $this->db->get('document');
		return $query->row_object();
	}

	public function addDocument($data) 
	{
		$this->db->insert('document', $data);
		return $this->db->affected_rows();
	}

	public function editDocument($id, $data) 
	{
		$this->db->where('id', $id);
		$this->db->update('document', $data);
		return $this->db->affected_rows();
	}

	public function deleteDocument($id) 
	{
		$this->db->where('id', $id);
		$this->db->update('document', array('del'=>1));
		return $this->db->affected_rows();
	}
}