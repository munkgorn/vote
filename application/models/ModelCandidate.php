<?php  
class ModelCandidate extends CI_Model {

	public function add($data) 
	{
		$data['date_added']  = date('Y-m-d H:i:s', time());
		$data['date_modify'] = date('Y-m-d H:i:s', time());
		$data['del']         = 0;
		// $data['status']      = null;
		$data['status'] = 1;

		$this->db->insert('candidate', $data);
		$recruiting_id = $this->db->insert_id();

		return $recruiting_id;
	}

	public function edit($id, $data) 
	{
		$data['date_modify'] = date('Y-m-d H:i:s', time());
		$data['del']         = 0;

		$this->db->where('id', $id);
		$this->db->update('candidate', $data);
		return $this->db->affected_rows();
	}

	public function delete($id) 
	{
		$this->db->where('id', $id);
		$this->db->update('candidate', array('del'=>1));
		return $this->db->affected_rows();
	}

	public function status($id, $status) 
	{
		$this->db->where('id', $id);
		$this->db->update('candidate', array('status'=>$status));
		return $this->db->affected_rows();
	}

	public function status_pass($id, $status) 
	{
		$this->db->where('id', $id);
		$this->db->update('candidate', array('status_pass'=>$status));
		return $this->db->affected_rows();
	}

	public function getLists($recruiting_id, $type_id=null, $filter=array())
	{
		$this->db->select('candidate.*, candidate.id as id, candidate.status as status, member.prefix_name as member_prefix, member.firstname as firstname, member.lastname as lastname, member_group.name as member_group_name');
		$this->db->where('candidate.recruiting_id', $recruiting_id);
		if ($type_id>0) {
			$this->db->where('candidate.type_id', $type_id);
		}
		$this->db->where('candidate.del', 0);
		$this->db->join('member', 'member.id = candidate.member_id', 'left');
		$this->db->join('member_group', 'member_group.id = member.id', 'left');

		// if (isset($filter['order_score'])) {
			// $this->db->order_by('candidate.score', $filter['order_score']);
			$this->db->order_by('candidate.score', 'DESC');
		// } else {
			// $this->db->order_by('cast( `vote_candidate`.`candidate_no` as unsigned)', 'asc');	
		// }
		
		// $this->db->order_by('candidate.id', 'desc');
		$query = $this->db->get('candidate');
		//echo $this->db->last_query();
		return $query->result();
	}

	public function getList($recruiting_id,$id)
	{
		$this->db->select('candidate.*, candidate.id as id, candidate.status as status, member.prefix_name as member_prefix, member.firstname as firstname, member.lastname as lastname');
		$this->db->where('candidate.recruiting_id', $recruiting_id);
		$this->db->where('candidate.id', $id);
		$this->db->where('candidate.del', 0);
		$this->db->join('member', 'member.id = candidate.member_id', 'left');
		$this->db->order_by('candidate.id', 'desc');
		$query = $this->db->get('candidate');
		return $query->row_object();
	}

	public function getTypeRecruiting($recruiting_id, $type_id)
	{

		$this->db->select('recruiting.*, document.name as file_name, committee.name as committee_name, committee.id as committee_id, recruiting_to_committee.id as recruiting_committee_id, member_group.name as member_group_name, member_group.id as member_group_id, recruiting_to_member_group.id as recruiting_member_group_id, region.name as region');

		$this->db->join('recruiting_to_file', 'recruiting.id = recruiting_to_file.recruiting_id', 'left');
		$this->db->join('document', 'document.id = recruiting_to_file.document_id', 'left');

		$this->db->join('recruiting_to_committee', 'recruiting.id = recruiting_to_committee.recruiting_id', 'left');
		$this->db->join('committee', 'committee.id = recruiting_to_committee.committee_id', 'left');

		$this->db->join('recruiting_to_member_group', 'recruiting.id = recruiting_to_member_group.recruiting_id', 'left');
		$this->db->join('member_group', 'member_group.id = recruiting_to_member_group.member_group_id', 'left');
		$this->db->join('region', 'region.id = member_group.region_id', 'left');
		
		$this->db->where('recruiting.id', $recruiting_id);
		$this->db->where('recruiting.del', 0);
		$query = $this->db->get('recruiting');
		return $query->result();
	}

	

}
?>