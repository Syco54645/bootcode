<?php
	class Allowance_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		
		public function getAllowance($co_id, $type=""){
			$this->db->select('*');
			$this->db->from('allowance a');
			$this->db->where('a.allow_type', $type);
			$this->db->where('a.co_id', $co_id);
			$query = rset($this->db->get());
			
			if (is_array($query)) return $query;
			else return array();
			
		}

	}
