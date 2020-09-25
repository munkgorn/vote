<?php  
class ModelRegion extends CI_Model {

	public $id;
	public $name;

	public function getLists() 
	{
		$query = $this->db->get('region');
		return $query->result();
	}
}