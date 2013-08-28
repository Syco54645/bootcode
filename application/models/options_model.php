<?php
	class Options_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		

		public function returnOption($o='theme'){
			$this->db->select('option_value');
			$this->db->from('blog_options as bo');

			$this->db->where('option_name', $o);
			
			$query = rset($this->db->get());

			if (is_array($query)) return $query[0]['option_value'];
			else return false;
		}

	}
