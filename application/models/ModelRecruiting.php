<?php  
class ModelRecruiting extends CI_Model {

	public function updateTable() 
	{
		$sql = "ALTER TABLE vote_recruiting ADD sort INT(11) after recruiting_type";
		$this->db->query($sql);
		$affected = $this->db->affected_rows();

		$this->db->where('del', 0);
		$query = $this->db->get('recruiting');
		$results = $query->result_array();
		$i=1;
		foreach ($results as $value) {
			$this->db->where('id', $value['id']);
			$this->db->update('recruiting', array('sort'=>$i));
			$i++;
		}
		return $affected;
	}

	public function getSort()
	{
		$query = $this->db->query("SELECT count(*) as count FROM vote_recruiting WHERE del=0");
		$result = $query->row_array();
		return $result['count'] + 1;
	}

	public function add($data) 
	{
		$file = $data['file'];
		unset($data['file']); // ? bug

		$data['date_added']  = date('Y-m-d H:i:s', time());
		$data['date_modify'] = date('Y-m-d H:i:s', time());
		$data['del']         = 0;

		
		$committees = isset($data['committee']) ? $data['committee'] : array();
		$members = isset($data['members']) ? $data['members'] : array();
		unset($data['committee'],$data['members'],$data['member_group']);
		
		$this->db->insert('recruiting', $data);
		$recruiting_id = $this->db->insert_id();

		// Committee
		if ($data['recruiting_type']=='committee') {
			foreach ($committees['receiving'] as $key => $value) {
				$committee['recruiting_id'] = $recruiting_id;
				$committee['committee_id']  = $key;
				$committee['receiving']     = (int)$value;
				$committee['reserve']       = (int)$committees['reserve'][$key];
				if (
					!empty($committee['receiving'])&&$committee['receiving']>0 
					// && !empty($committee['reserve'])&&$committee['reserve']>0
				) {
					$this->db->insert('recruiting_to_committee', $committee);	
				}
				
			}	
		}
		// Committee

		// Members
		if ($data['recruiting_type']=='members') {
			foreach ($members['receiving'] as $key => $value) {
				$member['recruiting_id']   = $recruiting_id;
				$member['member_group_id'] = $key;
				$member['receiving']       = (int)$value;
				$member['reserve']         = (int)$members['reserve'][$key];
				if (
					!empty($member['receiving'])&&$member['receiving']>0 
					// && !empty($member['reserve'])&&$member['reserve']>0
				) {
					$this->db->insert('recruiting_to_member_group', $member);	
				}
				
			}	
		}
		// Members

		// document
		if (isset($file)&&!empty($file)&&is_array($file)) {
			$this->db->where('recruiting_id', $recruiting_id);
			$this->db->delete('recruiting_to_file');
			if (count($file)>0) {
				foreach ($file as $document_id => $checked) {
					$file_insert['recruiting_id'] = $recruiting_id;
					$file_insert['document_id'] = $document_id;
					$this->db->insert('recruiting_to_file', $file_insert);
				}
			}
		}
		// document
		

		return $recruiting_id;
	}

	public function edit($recruiting_id, $data) 
	{
		$file = $data['file'];
		unset($data['file']); // ? bug

		$data['date_modify'] = date('Y-m-d H:i:s', time());
		$data['del']         = 0;

		$committees = isset($data['committee']) ? $data['committee'] : array();
		$members = isset($data['members']) ? $data['members'] : array();
		unset($data['committee'],$data['members']);

		unset($data['member_group']);

		$this->db->where('id', $recruiting_id);
		$this->db->update('recruiting', $data);
		$result = $this->db->affected_rows();

		// Committee
		if ($data['recruiting_type']=='committee') {
			if (count($committees['receiving'])>0) {
				// $this->db->where('recruiting_id', $recruiting_id);
				// $query = $this->db->get('recruiting_to_committee');

				// $this->db->delete('recruiting_to_committee');
				foreach ($committees['receiving'] as $key => $value) {
					$this->db->where('recruiting_id', $recruiting_id);
					$this->db->where('committee_id', $key);
					$this->db->delete('recruiting_to_committee');
					// $query = $this->db->get('recruiting_to_committee');
					// if ($this->db->affected_rows()==1) {
					// 	$this->db->where('recruiting_id', $recruiting_id);
					// 	$this->db->where('committee_id', $key);
					// 	$committee['receiving']     = $value;
					// 	$committee['reserve']       = $committees['reserve'][$key];
					// 	if (
					// 		!empty($committee['receiving'])&&$committee['receiving']>0 && 
					// 		!empty($committee['reserve'])&&$committee['reserve']>0
					// 	) {
					// 		$this->db->update('recruiting_to_committee', $committee);
					// 	}
					// } else {
						$committee['recruiting_id'] = $recruiting_id;
						$committee['committee_id']  = $key;
						$committee['receiving']     = (int)$value;
						$committee['reserve']       = (int)$committees['reserve'][$key];
						if (
							!empty($committee['receiving'])&&$committee['receiving']>0 
							// && !empty($committee['reserve'])&&$committee['reserve']>0
						) {
							$this->db->insert('recruiting_to_committee', $committee);	

						}
					// }
					
				}	
			}
		}
		// Committee

		// Members
		if ($data['recruiting_type']=='members') {
			if (count($members['receiving'])>0) {
				foreach ($members['receiving'] as $key => $value) {


					$this->db->where('recruiting_id', $recruiting_id);
					$this->db->where('member_group_id', $key);
					$this->db->delete('recruiting_to_member_group');
					// $query = $this->db->get('recruiting_to_member_group');

					// var_dump($member['receiving']);
					// var_dump($member['reserve']);
					// if ($this->db->affected_rows()==1) {
					// 	$member['receiving']       = $value;
					// 	$member['reserve']         = $members['reserve'][$key];

					// 	if (
					// 		!empty($member['receiving'])&&$member['receiving']>0 && 
					// 		!empty($member['reserve'])&&$member['reserve']>0
					// 	) {
					// 	echo 'update';
					// 		$this->db->where('recruiting_id', $recruiting_id);
					// 		$this->db->where('member_group_id', $key);
					// 		$this->db->update('recruiting_to_member_group', $member);	
					// 	}
					// } else {
						$member['recruiting_id']   = $recruiting_id;
						$member['member_group_id'] = $key;
						$member['receiving']       = (int)$value;
						$member['reserve']         = (int)$members['reserve'][$key];
						if (
							!empty($member['receiving'])&&$member['receiving']>0 
							// && !empty($member['reserve'])&&$member['reserve']>0
						) {
							$this->db->insert('recruiting_to_member_group', $member);	
						}
						
					// }
					echo '<br>';
					
				}	

			}
		}
		// exit();
		// Members

		// document
		if (isset($file)&&!empty($file)&&is_array($file)) {
			$this->db->where('recruiting_id', $recruiting_id);
			$this->db->delete('recruiting_to_file');
			if (count($file)>0) {
				foreach ($file as $document_id) {
					$file_insert['recruiting_id'] = $recruiting_id;
					$file_insert['document_id'] = $document_id;
					$this->db->insert('recruiting_to_file', $file_insert);
				}
			}
		}
		// document

		return $result;
	}

	public function delete($id) 
	{
		$this->db->where('id', $id);
		$this->db->update('recruiting', array('del'=>1));
		return $this->db->affected_rows();
	}

	public function changeStatus($id, $status=1) 
	{
		$this->db->where('id', $id);
		$this->db->update('recruiting', array('status'=>$status));
		return $this->db->affected_rows();
	}

	public function getListsGroupByYear() 
	{
		$this->db->where('del', 0);
		$this->db->group_by('year');
		$query = $this->db->get('recruiting');
		return $query->result();
	}

	public function getListsGroupBySet($year) 
	{
		$this->db->where('del', 0);
		$this->db->where('year', $year);
		$this->db->group_by('set');
		$query = $this->db->get('recruiting');
		return $query->result();
	}

	public function getListsByYearSet($filter=array())
	{
		if (isset($filter['year'])&&isset($filter['set'])) {
			if ($filter['year']) {
				$this->db->where('recruiting.year', $filter['year']);
			}
			if ($filter['set']) {
				$this->db->where('recruiting.set', $filter['set']);
			}
		}
		$this->db->where('recruiting.del', 0);
		$query = $this->db->get('recruiting');
		return $query->result();
	}

	public function getLists() 
	{	
		// $this->db->cache_on();
		$this->db->where('del', 0);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('recruiting');
		return $query->result();
	}

	public function getList($id) 
	{	
		$this->db->where('del', 0);
		$this->db->where('id', $id);
		$query = $this->db->get('recruiting');
		return $query->row_object();
	}

	public function findTypeRecruiting($recruiting_id) 
	{
		$this->db->where('id', $recruiting_id);
		$query = $this->db->get('recruiting');	
		if ($this->db->affected_rows()==1) {
			$recruiting_info = $query->result();
			if ($recruiting_info->recruiting_type=='committee') {
				$this->db->select('committee.name as type_name');
				$this->db->where('recruiting_to_committee.recruiting_id', $recruiting_info->id);
				// $this->db->where('recruiting_to_committee.id', $candidate_info->type_id);
				$this->db->join('committee', 'committee.id=recruiting_to_committee.committee_id');
				$query = $this->db->get('recruiting_to_committee');
				$type_info = $query->row_object();
				// echo $this->db->last_query();
				$recruiting_info->type_name = $type_info->type_name;
			}
			else if ($recruiting_info->recruiting_type=='members') {
				$this->db->select('member_group.name as type_name');
				$this->db->where('recruiting_to_member_group.recruiting_id', $recruiting_info->id);
				// $this->db->where('recruiting_to_member_group.member_group_id', $candidate_info->type_id);
				$this->db->join('member_group', 'member_group.id=recruiting_to_member_group.member_group_id');
				$query = $this->db->get('recruiting_to_member_group');
				$type_info = $query->row_object();
				// echo $this->db->last_query();
				$recruiting_info->type_name = $type_info->type_name;
			}
			return $recruiting_info;
		}
	}

	public function findType($candidate_id) 
	{
		$this->db->where('id', $candidate_id);
		$query = $this->db->get('candidate');
		if ($this->db->affected_rows()==1) {
			$candidate_info = $query->row_object();
			$type_id = $candidate_info->type_id;
			$this->db->where('id', $candidate_info->recruiting_id);
			$query = $this->db->get('recruiting');	
			if ($this->db->affected_rows()==1) {
				$recruiting_info = $query->row_object();

				if ($recruiting_info->recruiting_type=='committee') {
					$this->db->select('committee.name as type_name,recruiting_to_committee.receiving,recruiting_to_committee.reserve');
					$this->db->where('recruiting_to_committee.recruiting_id', $recruiting_info->id);
					$this->db->where('committee.id', $candidate_info->type_id);
					$this->db->join('committee', 'committee.id=recruiting_to_committee.committee_id');
					$query = $this->db->get('recruiting_to_committee');
					$type_info = $query->row_object();
					// echo $this->db->last_query();
					$candidate_info->type_name = $type_info->type_name;
					$candidate_info->receiving = $type_info->receiving;
					$candidate_info->reserve = $type_info->reserve;
				}
				else if ($recruiting_info->recruiting_type=='members') {
					$this->db->select('member_group.name as type_name,recruiting_to_member_group.receiving,recruiting_to_member_group.reserve');
					$this->db->where('recruiting_to_member_group.recruiting_id', $recruiting_info->id);
					$this->db->where('recruiting_to_member_group.member_group_id', $candidate_info->type_id);
					$this->db->join('member_group', 'member_group.id=recruiting_to_member_group.member_group_id');
					$query = $this->db->get('recruiting_to_member_group');
					$type_info = $query->row_object();
					// echo $this->db->last_query();
					$candidate_info->type_name = $type_info->type_name;
					$candidate_info->receiving = $type_info->receiving;
					$candidate_info->reserve = $type_info->reserve;
				}
			}
			return $candidate_info;
		}
	}

	public function countScore($recruiting_id) 
	{
		$this->db->where('recruiting_id', $recruiting_id);
		$query = $this->db->get('candidate');
		$candidates = $query->result();
		if (count($candidates)>0) {
			$i = 1;
			
			foreach ($candidates as $candidate) {
				$count = 0;
				$candidate_id = $candidate->id;

				$this->db->select('vote');
				$this->db->where('candidate_id', $candidate_id);
				$this->db->where('recruiting_id', $recruiting_id);
				$this->db->where('vote', 1);
				$this->db->group_by('member_id');
				$query = $this->db->get('score');
				//echo $this->db->last_query();
				$scores = $query->result();
				foreach ($scores as $score) {
					$count += $score->vote;
				}

				$this->db->where('id', $candidate_id);
				$this->db->update('candidate', array('score'=>$count));
				$i++;
			}
		}
	}

	public function getRecruitingCommittee($id)
	{
		// $this->db->cache_on();
		$this->db->select('recruiting_to_committee.*, committee.name as committee_name, committee.id as type_id');
		$this->db->join('committee', 'committee.id = recruiting_to_committee.committee_id');
		$this->db->join('recruiting', 'recruiting.id = recruiting_to_committee.recruiting_id');
		$this->db->where('recruiting.del', 0);
		$this->db->where('recruiting_to_committee.recruiting_id', $id);
		$query = $this->db->get('recruiting_to_committee');
		return $query->result();
	}

	public function getRecruitingMemberGroup($id)
	{

		// $this->db->cache_on();
		$this->db->select('member_group.id as id , recruiting_to_member_group.*, member_group.name as member_group_name, member_group.id as type_id');
		$this->db->join('member_group', 'member_group.id = recruiting_to_member_group.member_group_id');
		$this->db->join('recruiting', 'recruiting.id = recruiting_to_member_group.recruiting_id');
		$this->db->where('recruiting.del', 0);
		$this->db->where('recruiting_to_member_group.recruiting_id', $id);
		$query = $this->db->get('recruiting_to_member_group');
		return $query->result();
	}

	public function getRecruitingFile($id)
	{
		$this->db->select('recruiting_to_file.*, document.name as document_name');
		$this->db->join('document', 'document.id = recruiting_to_file.document_id');
		$this->db->where('recruiting_to_file.recruiting_id', $id);
		$this->db->where('document.del', 0);
		$query = $this->db->get('recruiting_to_file');
		return $query->result();
	}

	public function getListsWithType($id=0)
	{
		$this->db->select('recruiting.*, document.name as file_name, committee.name as committee_name, committee.id as committee_id, recruiting_to_committee.id as recruiting_committee_id, member_group.name as member_group_name, member_group.id as member_group_id, recruiting_to_member_group.id as recruiting_member_group_id, region.name as region');

		$this->db->join('recruiting_to_file', 'recruiting.id = recruiting_to_file.recruiting_id', 'left');
		$this->db->join('document', 'document.id = recruiting_to_file.document_id', 'left');

		$this->db->join('recruiting_to_committee', 'recruiting.id = recruiting_to_committee.recruiting_id', 'left');
		$this->db->join('committee', 'committee.id = recruiting_to_committee.committee_id', 'left');

		$this->db->join('recruiting_to_member_group', 'recruiting.id = recruiting_to_member_group.recruiting_id', 'left');
		$this->db->join('member_group', 'member_group.id = recruiting_to_member_group.member_group_id', 'left');
		$this->db->join('region', 'region.id = member_group.region_id', 'left');
		
		if ($id>0) {
			$this->db->where('recruiting.id', $id);	
		}
		
		$this->db->where('recruiting.del', 0);
		$query = $this->db->get('recruiting');

		// echo $this->db->last_query();
		return $query->result();
	}

	public function getListsWithMemberGroupId($member_group_id=0)
	{
		$this->db->select('recruiting.*, document.name as file_name, member_group.name as member_group_name, member_group.id as member_group_id, recruiting_to_member_group.id as recruiting_member_group_id, region.name as region');

		$this->db->join('recruiting_to_file', 'recruiting.id = recruiting_to_file.recruiting_id', 'left');
		$this->db->join('document', 'document.id = recruiting_to_file.document_id', 'left');

		// $this->db->join('recruiting_to_committee', 'recruiting.id = recruiting_to_committee.recruiting_id', 'left');
		// $this->db->join('committee', 'committee.id = recruiting_to_committee.committee_id', 'left');

		$this->db->join('recruiting_to_member_group', 'recruiting.id = recruiting_to_member_group.recruiting_id', 'left');
		$this->db->join('member_group', 'member_group.id = recruiting_to_member_group.member_group_id', 'left');
		$this->db->join('region', 'region.id = member_group.region_id', 'left');
		
		if ($member_group_id>0) {
			$this->db->where('member_group.id', $member_group_id);	
		}
		
		$this->db->where('recruiting.del', 0);
		$query = $this->db->get('recruiting');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	// public function getType() 
	// {
	// 	$query = $this->db->get('recruiting');

	// }

}
?>