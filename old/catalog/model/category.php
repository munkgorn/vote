<?php 
	class CategoryModel extends db {
		public function listCategory($data=array()){
			$result = array();
			$result_status = '';
			$result_detail = '';
			$categories = array();
			
			$sql = "SELECT 
				sl_category.id_category,
				sl_language_category.title
			FROM sl_category INNER JOIN sl_language_category ON sl_category.id_category = sl_language_category.id_category
			WHERE sl_category.id_category_parent = 1 AND sl_language_category.id_language = ".DEFAULT_LANGUAGE;
			$result_category = $this->query($sql);
			if($result_category->num_rows > 0){ 

				$where = '';
				if(!empty($data['id_member'])){
					$where = ' where sl_take_member_content.id_member='.$data['id_member'];
				}
				foreach($result_category->rows as $val){
					$result_list_category = $this->getListSubCategory($val['id_category']);
					$sub_category = array();
					foreach($result_list_category as $val_sub){
						// echo $val_sub['id_category'].' ';exit();
						$result_content = $this->getContents($val_sub['id_category']);
						// var_dump($result_content);exit();
						$sub_category[] = array(
							'category_id' => $val['id_category'],
							'title' => $val_sub['title'],
							'sub_content' => $result_content
						);
					}
					
					$list = array();
					$sql_get_list = "SELECT sl_content.id_category, 
						sl_language_content.id_content, 
						sl_language_content.title, 
						tchk.id_member AS checked
					FROM sl_content INNER JOIN sl_language_content ON sl_content.id_content = sl_language_content.id_content
						 LEFT JOIN (SELECT * FROM sl_take_member_content ".$where.") tchk ON sl_language_content.id_content = tchk.id_content
					WHERE sl_content.id_category = ".$val['id_category']." AND sl_language_content.id_language = ".DEFAULT_LANGUAGE." GROUP BY sl_language_content.id_content";
					// echo $sql_get_list;
					$result_list = $this->query($sql_get_list);
					foreach($result_list->rows as $val_list){
						$list[] = array(
							'id_content' => $val_list['id_content'],
							'title' => $val_list['title'],
							'checked' => $val_list['checked']
						);
					}
					$categories[] = array(
						'id_category' => $val['id_category'],
						'title' => $val['title'],
						'list'=> $list,
						'sub_category' => $sub_category
					);
					$result_status = 'success';
					$result_detail = $categories;
				} 
			}else{
				$result_status = 'fail';
				$result_detail = 'Not have category';
			}
			$result['result'] = $result_status;
			$result['detail'] = $result_detail;
			return $result;
		}
		public function listCategoryContent($id_category){
			$result = array();
			$result_status = '';
			$result_detail = '';
			$categories = array();
			
			$sql = "SELECT 
				sl_category.id_category,
				sl_language_category.title
			FROM sl_category INNER JOIN sl_language_category ON sl_category.id_category = sl_language_category.id_category
			WHERE sl_category.id_category = ".$id_category." AND sl_language_category.id_language = ".DEFAULT_LANGUAGE;
			$result_category = $this->query($sql);
			if($result_category->num_rows > 0){ 

				foreach($result_category->rows as $val){
					$result_list_category = $this->getListSubCategory($val['id_category']);
					$sub_category = array();
					foreach($result_list_category as $val_sub){
						// echo $val_sub['id_category'].' ';exit();
						$result_content = $this->getContents($val_sub['id_category']);
						// var_dump($result_content);exit();
						$sub_category[] = array(
							'category_id' => $val['id_category'],
							'title' => $val_sub['title'],
							'sub_content' => $result_content
						);
					}
					
					$list = array();
					$sql_get_list = "SELECT sl_content.id_category, 
						sl_language_content.id_content, 
						sl_language_content.title, 
						tchk.id_member AS checked
					FROM sl_content INNER JOIN sl_language_content ON sl_content.id_content = sl_language_content.id_content
						 LEFT JOIN (SELECT * FROM sl_take_member_content ) tchk ON sl_language_content.id_content = tchk.id_content
					WHERE sl_content.id_category = ".$val['id_category']." AND sl_language_content.id_language = ".DEFAULT_LANGUAGE." GROUP BY sl_language_content.id_content";
					// echo $sql_get_list;
					$result_list = $this->query($sql_get_list);
					foreach($result_list->rows as $val_list){
						$list[] = array(
							'id_content' => $val_list['id_content'],
							'title' => $val_list['title'],
							'checked' => $val_list['checked']
						);
					}
					$categories[] = array(
						'id_category' => $val['id_category'],
						'title' => $val['title'],
						'list'=> $list,
						'sub_category' => $sub_category
					);
					$result_status = 'success';
					$result_detail = $categories;
				} 
			}else{
				$result_status = 'fail';
				$result_detail = 'Not have category';
			}
			$result['result'] = $result_status;
			$result['detail'] = $result_detail;
			return $result;
		}
		public function getListCategory($id_category=0){
			$result = array();
			$sql_get_list = "SELECT sl_content.id_category, 
				sl_language_content.id_content, 
				sl_language_content.title
			FROM sl_content INNER JOIN sl_language_content ON sl_content.id_content = sl_language_content.id_content
			WHERE sl_content.id_category = ".$id_category." AND sl_language_content.id_language = ".DEFAULT_LANGUAGE;
			$result_list = $this->query($sql_get_list)->rows;
			return $result_list;
		}
		public function getListSubCategory($id_category=0){
			$result = array();
			$sql_get_list = "SELECT sl_category.id_category, 
				sl_language_category.title
			FROM sl_category INNER JOIN sl_language_category ON sl_category.id_category = sl_language_category.id_category
			WHERE sl_category.id_category_parent = ".$id_category." AND sl_language_category.id_language = ".DEFAULT_LANGUAGE;
			$result_list = $this->query($sql_get_list)->rows;
			// echo $sql_get_list." ";
			return $result_list;
		}
		public function getContent($id_content=0){
			$result = array();
			$sql_get_list = "SELECT sl_content.id_category, 
				sl_language_content.id_content, 
				sl_language_content.title
			FROM sl_content INNER JOIN sl_language_content ON sl_content.id_content = sl_language_content.id_content
			WHERE sl_content.id_content = ".$id_content." AND sl_language_content.id_language = ".DEFAULT_LANGUAGE;
			$result_list = $this->query($sql_get_list)->row;
			return $result_list;
		}
		public function getContents($id_category=0){
			$result = array();
			$sql_get_list = "SELECT sl_content.id_category, 
				sl_language_content.id_content, 
				sl_language_content.title
			FROM sl_content INNER JOIN sl_language_content ON sl_content.id_content = sl_language_content.id_content
			WHERE sl_content.id_category = ".$id_category." AND sl_language_content.id_language = ".DEFAULT_LANGUAGE;
			$result_list = $this->query($sql_get_list)->rows;
			return $result_list;
		}
		public function getListPerson($data=array()){
			$result = array();
			$id_content = (int)$data['id_content'];
			$name = $data['name'];
			$where = '';
			if($id_content==0){
				$id_content = 1;
			}
			if(!empty($name)){
				$where = " AND sl_member.member_name like '%".$name."%'";
			}
			$sql = "SELECT sl_member.* 
			FROM sl_member INNER JOIN sl_take_member_content ON sl_member.id_member = sl_take_member_content.id_member
			WHERE sl_take_member_content.id_content = ".$id_content.' 
			AND sl_member.id_member_type=2 '.$where.'
			group by sl_member.id_member ORDER BY member_suggest DESC';
			$result_content = $this->query($sql);
			$result = $result_content->rows;
			return $result;
		}
		public function getListPersonSuggest($data=array()){
			$result = array();
			$suggest = (int)$data['suggest'];
			$sql = "SELECT sl_member.* 
			FROM sl_member 
			WHERE sl_member.member_suggest = ".$suggest." AND sl_member.id_member_type=2 limit 0,4";
			$result_content = $this->query($sql);
			$result = $result_content->rows;
			return $result;
		}
		public function getReview($data=array()){
			$result = array();
			$id_member = $data['id_member'];
			$sql = "SELECT avg_star,title,review_star,avg_per_job FROM ( SELECT AVG(review_star)/5*100 AS avg_star,AVG(review_star) as avg_per_job,review_star,sl_review.id_content
			FROM sl_review 
			WHERE id_member=".$id_member." 
			GROUP BY sl_review.id_content ) t
			LEFT JOIN  sl_language_content ON sl_language_content.id_content = t.id_content
			WHERE sl_language_content.id_language = 2 AND avg_star >0 Limit 0,4";
			$result_content = $this->query($sql);
			$result = $result_content->rows;
			return $result;
		}
		
	}
?>