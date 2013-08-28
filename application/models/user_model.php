<?php
	class User_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}
		
		public function getProfile($id)
		{
			//todo reqwrite query
			$query = $this->db->query("SELECT * FROM user WHERE user_id=".$id);
			return $query->result();
		}

		public function getCompany($id)
		{

			$this->db->select('*');
			$this->db->from('company');
			$this->db->where('user_id', $id);
			$query = rset($this->db->get());
			
			if (is_array($query)) return $query[0];
			else return false;
		}

		public function updateProfile($data)
		{
			//echo $data['fname'];
			$arr = array(
				'user_fname' => $data['fname'],
				'user_lname' => $data['lname'],
				'email' => $data['email']
			);
			$this->db->where('user_id', $data['uid']);
			return $this->db->update('user', $arr);
			//$query = $this->db->query("UPDATE user SET user_fname='".$data."'");
			//return $query->result();
		}


	}