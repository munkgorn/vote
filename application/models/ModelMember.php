<?php
class ModelMember extends CI_Model
{

    // public $id;
    public $member_group_id;
    public $member_type_id;
    public $id_card;
    public $member_no;
    public $password;
    public $prefix_name;
    public $firstname;
    public $lastname;
    public $email;
    public $birthday;
    public $date_register;
    public $phone;
    public $status;
    public $date_added;
    public $date_modify;

    public function login($data)
    {
        $this->db->where('id_card', $data['id_card']);
        $this->db->where('member_no', (int)sprintf('%06d',$data['member_no']));
        $this->db->where('password', (int)sprintf('%04d',$data['password']));
        $this->db->where('status', 1);
        $query = $this->db->get('member');
        // return $this->db->last_query();
        return $query->row_array();
    }

    public function updateLogin($id_member, $date = '')
    {
        if (!empty($date)) {
            $this->db->where('id', $id_member);
            $this->db->update('member', array('date_login' => $date));
            return $this->db->affected_rows();
        } else {
            return false;
        }

    }

    public function checkLogin()
    {
        $this->db->where('id', $this->id);
        $this->db->where('member_no', $this->member_no);
        $this->db->where('password', $this->password);
        $this->db->where('id_card', $this->id_card);
        $this->db->where('status', 1);
        $query = $this->db->get('member');
        return $this->db->affected_rows();
    }

    public function add($data)
    {
        $data['date_added'] = date('Y-m-d H:i:s', time());
        $data['date_modify'] = date('Y-m-d H:i:s', time());
        $data['del'] = 0;

        $this->db->insert('member', $data);
        return $this->db->affected_rows();
    }

    public function edit($data, $id)
    {
        // $this->setData($data);
        $data['date_modify'] = date('Y-m-d H:i:s', time());
        $data['del'] = 0;

        $this->db->where('id', $id);
        $this->db->update('member', $data);
        return $this->db->affected_rows();
        // return $this->db->last_query();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('member', array('del' => 1));
        return $this->db->affected_rows();
    }

    public function getLists($filter = array())
    {

        if (isset($filter['start']) && isset($filter['limit'])) {
            $this->db->limit($filter['limit'], $filter['start']);
            unset($filter['start'], $filter['limit']);
        }

        if (is_array($filter) && count($filter) > 0) {
            foreach ($filter as $key => $value) {
                $key = str_replace('filter_', '', $key);
                if (!empty($value)) {
                    if ($key == 'date_score' || $key == 'member.member_group_id' || $key == 'region.id') {
                        $this->db->where($key, $value);
                    } else {
                        $this->db->like($key, $value);
                    }

                }
            }
        }
        $this->db->select('member.*, member.id as id, member_type.name as member_type_name, member_group.name as member_group_name');

        $this->db->join('member_type', 'member_type.id = member.member_type_id');
        $this->db->join('member_group', 'member_group.id = member.member_group_id');
        $this->db->join('region', 'region.id = member_group.region_id');
        $this->db->where('member.del', 0);

        $query = $this->db->get('member');
        // echo $this->db->last_query();
        // echo '<br>';
        return $query->result();
    }

    public function getList($id)
    {
        $this->db->select('member.*, member_type.name as member_type_name, member_group.name as member_group_name');
        $this->db->join('member_type', 'member_type.id = member.member_type_id');
        $this->db->join('member_group', 'member_group.id = member.member_group_id');
        $this->db->where('member.del', 0);
        $this->db->where('member.id', $id);
        $query = $this->db->get('member');
        // return $this->db->last_query();
        return $query->row_object();
    }

    public function getListByMemberNo($memberno)
    {
        $this->db->select('member.*, member_type.name as member_type_name, member_group.name as member_group_name');
        $this->db->join('member_type', 'member_type.id = member.member_type_id');
        $this->db->join('member_group', 'member_group.id = member.member_group_id');
        $this->db->where('member.del', 0);
        $this->db->where('member.member_no', $memberno);
        $query = $this->db->get('member');
        // return $this->db->last_query();
        return $query->row_array();
    }

    public function updateImportCSV() {
        $sql = "SELECT * FROM vote_member WHERE temp_member_group_code is not null";
        $query = $this->db->query($sql);
        $members = $query->result();
        foreach ($members as $member) {
            
            $temp = sprintf('%06d', $member->temp_member_group_code);
            $sql = "SELECT * FROM vote_member_group WHERE `code` = '".$temp."'";
            $query = $this->db->query($sql); 
            $member_group = $query->row_array();
            $password = str_replace('\r','',str_replace('\n','',str_replace('\t','', trim($member->temp_member_group))));

            $sql = "UPDATE vote_member SET member_type_id = 3, member_group_id = '".$member_group['id']."', `password`='".$password."',`status`=1,date_added='".date('Y-m-d H:i:s', time())."',date_modify='".date('Y-m-d H:i:s', time())."',del=0 WHERE id='".$member->id."'";
            $this->db->query($sql);

            $newmemberno = sprintf('%06d',$member->member_no);
            $sql = "UPDATE vote_member SET member_no = '".$newmemberno."' WHERE id='".$member->id."'";
            $this->db->query($sql);
        }
    }

    public function importCSV($file)
    {
        date_default_timezone_set("Asia/Bangkok");

        $sql = "LOAD DATA LOCAL INFILE '" . $this->config->item('base_document') . $file . "' INTO TABLE vote_member FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 ROWS (member_no, prefix_name, firstname, lastname, id_card, temp_member_group, temp_member_group_code, phone);";
        $query = $this->db->query($sql);
        $result = $this->db->affected_rows();

        $this->updateImportCSV();

        


        // $sql = "UPDATE vote_member m ";
        // $sql .= "LEFT JOIN vote_member_group mg ON mg.`code` = LPAD(m.temp_member_group_code, 6, '0') ";
        // $sql .= "SET ";
        // $sql .= "m.member_type_id = 3, ";
        // $sql .= "m.member_group_id = mg.id, ";
        // $sql .= "m.`password` = TRIM(REPLACE(REPLACE(REPLACE(REPLACE(m.`temp_member_group`,' ',''),'\t',''),'\n',''),'\r','')), ";
        // $sql .= "m.status = 1, ";
        // $sql .= "m.date_added = '', ";
        // $sql .= "m.date_modify = '', ";
        // $sql .= "m.del = 0 ";
        // $sql .= "WHERE m.temp_member_group_code is not null ";
        // $this->db->query($sql); 


        // $query = $this->db->query("SELECT * FROM vote_member WHERE temp_member_group is not null");
        // $results = $query->result();
        // foreach ($results as $value) {

            // $sql = "UPDATE vote_member SET vote_member.member_type_id = 3, ";
            // $sql .= "vote_member.member_group_id = " . $result_member_group['id'] . ", ";
            // $sql .= "vote_member.`password` = TRIM(REPLACE(REPLACE(REPLACE(REPLACE(`vote_member`.`temp_member_group`,' ',''),'\t',''),'\n',''),'\r','')), ";
            // $sql .= "vote_member.temp_member_group = null, ";
            // $sql .= "vote_member.`status` = 1, vote_member.date_added = '" . date('Y-m-d H:i:s', time()) . "', vote_member.date_modify = '" . date('Y-m-d H:i:s', time()) . "', vote_member.del = 0 ";
            // $sql .= "WHERE vote_member.member_group_id is null "; 

            // $query = $this->db->query($sql);  
        // }

        // $sql = "UPDATE vote_member SET member_type_id = 3, member_group_id = (SELECT vote_member_group.id FROM vote_member_group WHERE vote_member_group.`code` = vote_member.temp_member_group_code LIMIT 0,1), temp_member_group = '', `password` = TRIM(REPLACE(REPLACE(REPLACE(REPLACE(`password`,' ',''),'\t',''),'\n',''),'\r','')), date_register = '".date('Y-m-d',time())."', status = 1, date_added = '".date('Y-m-d H:i:s',time())."', date_modify = '".date('Y-m-d H:i:s',time())."', del = 0 WHERE temp_member_group != ''; ";

        // $sql = "SELECT member_group_id,temp_member_group_code FROM vote_member m LEFT JOIN vote_member_group mg ON mg.id = m.member_group_id WHERE member_group_id is not null GROUP BY member_group_id";
        // $query = $this->db->query($sql);
        // foreach ($query->result_array() as $value) {
        // $sql = "UPDATE vote_member_group SET code = '".sprintf('%06d', (int)$value['temp_member_group_code'])."' WHERE id='".(int)$value['member_group_id']."'";
        //     $query = $this->db->query($sql);
        // }

        return $result;
    }

    public function getPrefixs()
    {
        $this->db->where('del', 0);
        $query = $this->db->get('member_prefix');
        return $query->result();
    }

    public function getPrefix($id)
    {
        $this->db->where('del', 0);
        $this->db->where('id', $id);
        $query = $this->db->get('member_prefix');
        return $query->row_object();
    }

    public function addPrefix($data)
    {
        $this->db->insert('member_prefix', $data);
        return $this->db->affected_rows();
    }

    public function editPrefix($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('member_prefix', $data);
        return $this->db->affected_rows();
    }

    public function deletePrefix($id)
    {
        $this->db->where('id', $id);
        $this->db->update('member_prefix', array('del' => 1));
        return $this->db->affected_rows();
    }

    public function exportCSV($filter = array())
    {
        $this->load->dbutil();
        if (is_array($filter) && count($filter) > 0) {
            foreach ($filter as $key => $value) {
                $key = str_replace('filter_', '', $key);
                if (!empty($value)) {
                    $this->db->where($key, $value);
                }
            }
        }
        $this->db->select('member.member_no as รหัสสมาชิก, member.prefix_name as คำนำหน้า, member.firstname as ชื่อ, member.lastname as นามสกุล, member.id_card as รหัสบัตรประชาชน, member.password as รหัสผ่าน, member_group.name as หน่วยงาน, phone as เบอร์โทรศัพท์');
        $this->db->join('member_type', 'member_type.id = member.member_type_id');
        $this->db->join('member_group', 'member_group.id = member.member_group_id');
        $this->db->where('member.status', 1);
        $query = $this->db->get('member');
        echo $this->dbutil->csv_from_result($query);
        // return $query->result_array();
    }

    public function exportGroupCSV()
    {
        $this->load->dbutil();
        $this->db->select('member_group.id as id, region.`name` as ภาค,  member_group.`name` as ชื่อกลุ่ม, \'\' as จำนวนผู้ได้รับตำแหน่ง, \'\' as จำนวนสำรอง');
        $this->db->join('region', 'region.id = member_group.region_id');
        $this->db->order_by('member_group.region_id', 'asc');

        $query = $this->db->get('member_group');

        // echo '<pre>';
        // print_r($query);
        // echo '</pre>';
        // exit();
        echo "ชุดที่,\nปีบัญชีที่,\n";
        echo "ครั้งที่สรรหา,\n\n";
        // echo "วันที่เปิดรับสมัคร,".date('Y-m-d H:i:s').",ถึงวันที่,".date('Y-m-d H:i:s')."\n";
        // echo "กำหนดวันลงคะแนน,".date('Y-m-d H:i:s').",ปิดลงคะแนน,".date('Y-m-d H:i:s')."\n";
        // echo "รายละเอียดเพิ่มเติม,\n";

        echo $this->dbutil->csv_from_result($query);
        // return $query->result_array();
    }

    public function importGroupCSV($file)
    {

        $row = 1;
        if (($handle = fopen($file, "r")) !== false) {

            $token = $this->session->userdata('token');
            $member = json_decode(base64_decode($token));

            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $insert['recruiting_member'] = 'members';
                $insert['member_id'] = $member['id'];

                $insert['date_register_start'] = date('Y-m-d H:i:s', time());
                $insert['date_register_end'] = date('Y-m-d H:i:s', time());

                $insert['date_score_start'] = date('Y-m-d H:i:s', time());
                $insert['date_score_end'] = date('Y-m-d H:i:s', time());

                $insert['date_added'] = date('Y-m-d H:i:s', time());
                $insert['date_modify'] = date('Y-m-d H:i:s', time());

                $insert['status'] = 0;
                $insert['del'] = 0;

                if ($row == 1) {
                    $insert['set'] = $data[1];
                }
                if ($row == 2) {
                    $insert['year'] = $data[1];
                }
                if ($row == 1) {
                    $insert['no'] = $data[1];
                }
                $row++;
                // for ($c=0; $c < $num; $c++) {
                //     echo $data[$c] . "<br />\n";
                // }
            }
            fclose($handle);
        }
        exit();
        // $sql = "LOAD DATA LOCAL INFILE '" . $this->config->item('base_document') . $file . "' INTO TABLE vote_member_group FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 ROWS (member_no, prefix_name, firstname, lastname, id_card, password, temp_member_group, phone);";
        // $query = $this->db->query($sql);
        // $result = $this->db->affected_rows();

        // $sql = "UPDATE vote_member SET member_type_id = 3, member_group_id = (SELECT vote_member_group.id FROM vote_member_group WHERE vote_member_group.`name` = vote_member.temp_member_group LIMIT 0,1), temp_member_group = '', password = md5(password), date_register = '".date('Y-m-d',time())."', status = 1, date_added = '".date('Y-m-d H:i:s',time())."', date_modify = '".date('Y-m-d H:i:s',time())."', del = 0 WHERE temp_member_group != ''; ";
        // $query = $this->db->query($sql);

        // return $result;
    }

    public function addGroup($insert = array())
    {
        $this->db->insert('member_group', $insert);
        return $this->db->affected_rows();
    }

    public function getGroups($filter = array())
    {
        if (isset($filter['region_id'])) {
            $this->db->where('region.id', $filter['region_id']);
        }
        $this->db->select('member_group.id as id, member_group.*, region.id as region_id, region.name as region_name');
        $this->db->join('region', 'region.id = member_group.region_id');
        $query = $this->db->get('member_group');
        return $query->result();
    }

    public function getGroup($id)
    {
        $this->db->where('member_group.id', $id);
        $this->db->select('member_group.*, region.name as region_name');
        $this->db->join('region', 'region.id = member_group.region_id');
        $query = $this->db->get('member_group');
        return $query->row_array();
    }

    public function getTypes()
    {
        $this->db->where('del', 0);
        $query = $this->db->get('member_type');
        return $query->result();
    }

    public function addType($data)
    {
        $this->db->insert('member_type', $data);
        return $this->db->affected_rows();
    }

    public function deleteType($id)
    {
        $this->db->where('id', $id);
        $this->db->update('member_type', array('del' => 1));
        return $this->db->affected_rows();

    }

    public function changepassword($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('password', $data['oldpassword']);
        $this->db->where('status', 1);
        $this->db->update('member', array('password' => $data['password']));
        return $this->db->affected_rows();
    }

    protected function setData($datas = array())
    {
        foreach ($datas as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function emptyAll()
    {
        date_default_timezone_set('Asia/Bangkok');

        $this->db->query('TRUNCATE `fsoftpro_vote`.`vote_member`');

        $insert = array(
            'member_group_id' => 2,
            'member_type_id' => 1,
            'id_card' => '9999999999999',
            'member_no' => '999999999',
            'password' => '898988',
            'prefix_name' => 'Mr',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'status' => 1,
            'date_added' => date('Y-m-d H:i:s', time()),
            'date_modify' => date('Y-m-d H:i:s', time()),
            'del' => 0,
        );
        $this->db->insert('member', $insert);
        return $this->db->affected_rows();
    }

}
