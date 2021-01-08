<?php  
class ModelNews extends CI_Model {

	public $news_type_id;
	public $name;
	public $detail;
	public $priority;
	public $date_show;
	public $date_end;
	public $file;
	public $date_added;
	public $date_modify;
	public $del;

	public function add($data) 
	{
		$this->setData($data);

		$this->date_added  = date('Y-m-d H:i:s', time());
		$this->date_modify = date('Y-m-d H:i:s', time());
		$this->del         = 0;

		$this->db->insert('news', $this);
		return $this->db->affected_rows();
	}

	public function edit($data, $id) 
	{
		$this->setData($data);
		$this->date_modify = date('Y-m-d H:i:s', time());
		$this->del         = 0;

		$this->db->where('id', $id);
		$this->db->update('news', $this);
		return $this->db->affected_rows();
	}

	public function delete($id) 
	{
		$this->db->where('id', $id);
		$this->db->update('news', array('del'=>1));
	}

	public function getLists() 
	{	
		// $this->db->cache_on();
		$this->db->select('news.*, news_type.name as type_name');
		$this->db->join('news_type', 'news_type.id = news.news_type_id');
		$this->db->where('news.del', 0);
		$query = $this->db->get('news');
		return $query->result();
	}

	public function getList($id)
	{
		$this->db->select('news.*, news_type.name as type_name');
		$this->db->join('news_type', 'news_type.id = news.news_type_id');
		$this->db->where('news.id', $id);
		$this->db->where('news.del', 0);
		$query = $this->db->get('news');
		return $query->row_object();
	}

	public function getTypes() 
	{
		$this->db->where('del', 0);
		$query = $this->db->get('news_type');
		return $query->result();
	}

	public function getType($id) 
	{
		$this->db->where('del', 0);
		$this->db->where('id', $id);
		$query = $this->db->get('news_type');
		return $query->row_object();
	}

	public function addType($data)
	{
		$this->db->insert('news_type', $data);
		return $this->db->affected_rows();
	}

	public function editType($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('news_type', $data);
		return $this->db->affected_rows();
	}

	public function deleteType($id) 
	{
		$this->db->where('id', $id);
		$this->db->update('news_type', array('del'=>1));
		return $this->db->affected_rows();
	}

	protected function setData($datas = array()) 
	{
		foreach ($datas as $key => $value) {
			$this->{$key} = $value;
		}
	}

}
?>