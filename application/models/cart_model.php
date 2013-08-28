<?php
	class Cart_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		
		public function searchCity( $term ){
			
			$this->db->select('*');
			$this->db->from('v_citystate');
			$this->db->where('region LIKE "%'.$term.'%" OR state_abbr LIKE "%'.$term.'%"');
			$query = rset($this->db->get());
			
			//echo $this->db->last_query(); exit;

			return $query;
		}
		
		public function getCities( $region_ids ){
			
			$this->db->select('CONCAT(region,", ",state_abbr) as city', false);
			$this->db->from('v_citystate');
			$this->db->where_in('region_id',$region_ids);

			$result = rset($this->db->get());
			return $result;

		}

		public function getStateId($state){

			$this->db->select('state_id');
			$this->db->from('lu_state');
			$this->db->where('state_abbr', $state);

			$result = rset($this->db->get());
			return $result;
		}

		public function checkAllowance($co_id, $allow_type){

			$this->db->select('*');
			$this->db->from('allowance');
			$this->db->where('co_id', $co_id);
			$this->db->where('allow_type', $allow_type);

			$result = rset($this->db->get());
			return $result;
		}

		public function insertAllowance($allow_type, $co_id, $allow_count, $expire){

			$expire = strtotime($expire);
			$expire = date('Y-m-d H:i:s', $expire);
			$data = array(
				'allow_type' => $allow_type,
				'co_id' => $co_id,
				'allow_expiration' => $expire,
				'allow_count' => $allow_count
			);

			$this->db->insert('allowance', $data); 

		}

		public function insertAdCity($co_id, $expire, $regions){

			$expire = strtotime($expire);
			$expire = date('Y-m-d H:i:s', $expire);
			$start=date('Y-m-d H:i:s');
			for($i=0; $i<count($regions);$i++){
				$ta=array(
							'region_id'=>$regions[$i],
							'co_id'=>$co_id,
							'ad_startdate'=>$start,
							'ad_expdate'=>$expire
						);
				$this->db->insert('ads', $ta); 
			}
			
		}

		public function insertAdState($co_id, $expire, $states){

			$expire = strtotime($expire);
			$expire = date('Y-m-d H:i:s', $expire);
			$start=date('Y-m-d H:i:s');
			for($i=0; $i<count($states);$i++){
				$ta=array(
							'state_id'=>$states[$i],
							'co_id'=>$co_id,
							'ad_startdate'=>$start,
							'ad_expdate'=>$expire
						);
				$this->db->insert('ads', $ta); 
			}
			
		}

		public function insertAdNation($co_id, $expire){

			$expire = strtotime($expire);
			$expire = date('Y-m-d H:i:s', $expire);
			$start=date('Y-m-d H:i:s');
			
			$ta=array(
						'co_id'=>$co_id,
						'country_id'=>10,
						'ad_startdate'=>$start,
						'ad_expdate'=>$expire
					);
			$this->db->insert('ads', $ta); 
		}

		public function insertAdSite($co_id, $expire){

			$expire = strtotime($expire);
			$expire = date('Y-m-d H:i:s', $expire);
			$start=date('Y-m-d H:i:s');
			
			$ta=array(
						'co_id'=>$co_id,
						'ad_startdate'=>$start,
						'ad_expdate'=>$expire
					);
			$this->db->insert('ads', $ta); 
		}

	}
?>