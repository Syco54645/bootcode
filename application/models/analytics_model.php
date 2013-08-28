<?php
	class Analytics_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}

		public function record($cid, $t, $loc){

			$date = date('Y-m-d');
			$this->db->select('count');
			$this->db->from('analytics');
			$this->db->where("date", $date);
			$this->db->where("co_id", $cid);
			$this->db->where("type", $t);
			$this->db->where("loc", $loc);
			$result = rset($this->db->get());

			if($result[0]['count']){
				//update the count
				$data = array(
					'count' => $result[0]['count']+1
				);

				$this->db->where("date", $date);
				$this->db->where("co_id", $cid);
				$this->db->where("type", $t);
				$this->db->update('analytics', $data); 
			}else{
				//none exist, insert the count
				$data = array(
					'co_id' => $cid ,
					'date' => $date ,
					'type' => $t,
					'count' => 1,
					'loc' =>$loc

				);

				$this->db->insert('analytics', $data); 
			}
		
		}
		
		
	}
