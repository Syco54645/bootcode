<?php
	class Post_model extends CI_Model {

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

			$this->db->where('p.status =', 1);
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query;
			else return false;
		}

		public function getBlogs(){
			$this->db->select('*');
			$this->db->from('posts as p');

			$this->db->where('p.parent =', -42);
			$this->db->order_by('date DESC');
			
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

	}
