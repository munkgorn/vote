<?php  
class ModelScore extends CI_Model {

	public function add($data) 
	{
		$data['date_score'] = date('Y-m-d', time());
		$data['date_added'] = date('Y-m-d H:i:s', time());
		$this->db->insert('score', $data);
		// echo $this->db->last_query();
		return $this->db->insert_id();
	}

	public function getListsVote($recruiting_id) {
		$this->db->select('score.member_id as member_id');
		$this->db->join('score', 'score.member_id=member.id');
		// $this->db->where('score.vote', 1);
		$this->db->where('score.recruiting_id', $recruiting_id);
		$this->db->group_by('score.member_id');
		$query = $this->db->get('member');
// echo $this->db->last_query();
		return $query->result();
	}
	public function getListsVoteNo($recruiting_id) {
		$this->db->select('score.member_id as member_id');
		$this->db->where('score.vote', 0);
		$this->db->where('score.recruiting_id', $recruiting_id);
		$this->db->join('score', 'score.member_id=member.id');
		$this->db->group_by('score.member_id');
		$query = $this->db->get('member');
//echo $this->db->last_query();
		return $query->result();
	}

	public function findMyScore($recruiting_id, $member_id)
	{
		$this->db->where('recruiting_id', $recruiting_id);
		$this->db->where('member_id', $member_id);
		//$this->db->group_by('member_id');
		$this->db->get('score');
		return $this->db->affected_rows();
	}

	public function findMyScoreNumber($recruiting_id, $member_id)
	{
		$this->db->where('recruiting_id', $recruiting_id);
		$this->db->where('member_id', $member_id);
		$query = $this->db->get('score');
		if ($this->db->affected_rows()>0) {
			$result = $query->row_object();
			return $result->vote;
		} else {
			return null;
		}
		
	}

	public function countNoVote($member_group_id, $filter=array())
	{
		if (isset($filter['date'])&&!empty($filter['date'])) {
			$this->db->where('date_score', $filter['date']);
		}
		if (isset($filter['date_start'])&&!empty($filter['date_start'])) {
			$this->db->where('score.date_added >=', $filter['date_start']);
		}
		if (isset($filter['date_end'])&&!empty($filter['date_end'])) {
			$this->db->where('score.date_added <=', $filter['date_end']);
		}
		if (isset($filter['recruiting_id'])) {
			$this->db->where('score.recruiting_id', $filter['recruiting_id']);
		}
		if (isset($member_group_id)&&!empty($member_group_id)) {
			$this->db->where('member.member_group_id', $member_group_id);
		}
		
		$this->db->where('score.vote', 0);
		$this->db->join('member','member.id = score.member_id');
		$this->db->group_by('score.member_id');
		$this->db->get('score');
		return $this->db->affected_rows();
	}

	public function countNoVote2($member_group_id, $filter=array())
	{
		if (isset($filter['date'])&&!empty($filter['date'])) {
			$this->db->where('date_score', $filter['date']);
		}
		if (isset($filter['recruiting_id'])) {
			$this->db->where('score.recruiting_id', $filter['recruiting_id']);
		}
		// $this->db->where('member.member_group_id', $member_group_id);
		$this->db->where('score.vote', 0);
		$this->db->join('member','member.id = score.member_id');
		$this->db->group_by('score.member_id');
		$this->db->get('score');
		return $this->db->affected_rows();
	}

	public function countMembergroup($member_group_id, $filter=array())
	{
		if (isset($filter['date'])&&!empty($filter['date'])) {
			$this->db->where('score.date_score', $filter['date']);
		}
		if (isset($filter['date_start'])&&!empty($filter['date_start'])) {
			$this->db->where('score.date_added >=', $filter['date_start']);
		}
		if (isset($filter['date_end'])&&!empty($filter['date_end'])) {
			$this->db->where('score.date_added <=', $filter['date_end']);
		}
		if (isset($filter['recruiting_id'])) {
			$this->db->where('score.recruiting_id', $filter['recruiting_id']);
		}
		if (isset($member_group_id)&&!empty($member_group_id)) {
			$this->db->where('member.member_group_id', $member_group_id);
		}
		if (isset($filter['is_vote'])&&$filter['is_vote']==true) {
			$this->db->where('score.vote', 1);
		}
		
		$this->db->join('member','member.id = score.member_id');
		$this->db->group_by('score.member_id');
		$this->db->get('score');
		
		// echo $this->db->last_query();
		// echo '<br>';
		// exit();
		return $this->db->affected_rows();
	}

	public function countMembergroup2($member_group_id, $filter=array())
	{
		if (isset($filter['date'])&&!empty($filter['date'])) {
			$this->db->where('score.date_score', $filter['date']);
		}
		if (isset($filter['recruiting_id'])) {
			$this->db->where('score.recruiting_id', $filter['recruiting_id']);
		}
		// $this->db->where('member.member_group_id', $member_group_id);
		// $this->db->where('score.vote', 1);
		$this->db->join('member','member.id = score.member_id');
		$this->db->group_by('score.member_id');
		$this->db->get('score');
		
		// echo $this->db->last_query();
		// exit();
		return $this->db->affected_rows();
	}

	public function exportScoreWithRangeTime()
	{
		
		$i=0;
		$result = array();
		$day = '2020-01-10';
		for ($i=0; $i<=23; $i++) {
			$hour = sprintf('%02d', $i);
			$nexthour = sprintf('%02d', ($i+1));
			$where = " WHERE s.date_added >= '$day $hour:00:00' AND s.date_added <= '$day $hour:59:59' ";
			$sql = "SELECT r.name as region_name, mg.name as member_group_name, SUM(s.vote) as vote, s.date_added FROM vote_score s LEFT JOIN vote_member m ON m.id = s.member_id LEFT JOIN vote_member_group mg ON mg.id = m.member_group_id LEFT JOIN vote_region r ON r.id = mg.region_id $where GROUP BY m.member_group_id ORDER BY r.id,mg.name ASC";
			$query = $this->db->query($sql);
			if (($i+6)>=18) { $j=17; } else { $j=$i; }
			$result[(sprintf('%02d',($j+6))).':00:00-'.(sprintf('%02d',($j+6))).':59:59'] = $query->result();
		}
		
		return $result;
	}

	
	public function countTimeScore($recruiting_id, $member_group_id, $start, $end) {
		$sql = "select count(s.id) as countvote from vote_score s LEFT JOIN vote_member m ON m.id=s.member_id LEFT JOIN vote_member_group mg ON mg.id=m.member_group_id where s.recruiting_id = $recruiting_id AND s.date_added BETWEEN '$start' AND '$end' AND mg.id = $member_group_id";
		$query = $this->db->query($sql);
		return $query->row_object()->countvote;
	}
}