<?php
	class Admin_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		

		public function getPages($p=0){
			$this->db->select('*');
			$this->db->from('posts as p');

			if($p){
				$this->db->where('p.parent =', $p);
			}else{
				$this->db->where('p.parent =', $p);
			}
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query;
			else return false;
		}

		public function getPostFromSlug($slug){
			//this will work for both blog entries and pages
			$this->db->select('*');
			$this->db->from('posts as p');

			$this->db->where('p.slug', $slug);
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query[0];
			else return false;
		}

		public function checkSlug($slug, $pid){

			$this->db->select('COUNT(*) as count');
			$this->db->from('posts');
			$this->db->where("slug", $slug);
			$this->db->where("post_id <> ".$pid);
			$result = rset($this->db->get());

			

			if($result[0]['count']){
				return false;
			}

			return true;
		}

		public function updateSlug($slug, $pid){
			
			$data=array(
						'slug'=>$slug
						);
			$this->db->where('post_id', $pid);
			$this->db->update('posts', $data);	
		}

		public function getPostFromId($post_id){
			//this will work for both blog entries and pages
			$this->db->select('*');
			$this->db->from('posts as p');

			$this->db->where('p.post_id', $post_id);
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query[0];
			else return false;
		}

		public function updatePost($title, $content, $status, $post_id){
			
			$data=array(
						'title'=>$title,
						'content'=>$content,
						'status'=>$status
						);
			$this->db->where('post_id', $post_id);
			$this->db->update('posts', $data);	
		}


		public function deleteCategories($pid){
			$this->db->where('post_id', $pid);
			$this->db->delete('post_category'); 
		}

		public function saveCategory($pid, $cid){
			$data = array(
				'post_id' => $pid,
				'category_id' => $cid
			);

			$this->db->insert('post_category', $data); 
		}














		public function getCategories(){
			$this->db->select('*');
			$this->db->from('categories');
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query;
			else return false;
		}

		public function getPostCategories($id){
			$this->db->select('*');
			$this->db->from('post_category');
			$this->db->where('post_id', $id);
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query;
			else return false;
		}

		public function getCompanies(){
			$this->db->select('*');
			$this->db->from('company as c');
			$this->db->join('lu_state as s','s.state_id=c.co_state');

			$query = rset($this->db->get());

			//echo $this->db->last_query();
			
			if (is_array($query)) return $query;
			else return false;
		}

		public function banCompany($id){
			
			$data=array(
						'co_ban'=>1
						);
			$this->db->where('co_id', $id);
			$this->db->update('company', $data);	
		}

		public function unbanCompany($id){
			
			$data=array(
						'co_ban'=>0
						);
			$this->db->where('co_id', $id);
			$this->db->update('company', $data);	
		}

		public function banUser($id){
			
			$data=array(
						'banned'=>1
						);
			$this->db->where('user_id', $id);
			$this->db->update('user', $data);	
		}

		public function unbanUser($id){
			
			$data=array(
						'banned'=>0
						);
			$this->db->where('user_id', $id);
			$this->db->update('user', $data);	
		}

	}
