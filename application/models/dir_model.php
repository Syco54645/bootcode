<?php
	class Dir_model extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}

		public function listRegions($id=1){

			$this->db->select('*');
			$this->db->from('lu_region as reg');
			$this->db->join('lu_state as st', 'reg.state_id = st.state_id');
			$this->db->where('st.state_id', $id);
			$regions = rset($this->db->get());
			
			$this->db->flush_cache();
			
			for ($i=0; $i < count($regions); $i++) { 
				$this->db->select('*');
				$this->db->from('regionlist as rl');
				$this->db->join('company as co','rl.co_id = co.co_id');
				$this->db->where('rl.region_id',$regions[$i]['region_id']);
				$regions[$i]['companies'] = rset($this->db->get());
			}	
			
			$this->db->flush_cache();
			
			for ($i=0; $i < count($regions); $i++) {
				for ($j=0; $j < count($regions[$i]['companies']); $j++) {
					$this->db->select('cat.cat_class');
					$this->db->from('company_category as cc');
					$this->db->join('lu_category as cat','cc.cat_id = cat.cat_id');
					$this->db->where('cc.co_id',$regions[$i]['companies'][$j]['co_id']);
					$regions[$i]['companies'][$j]['categories'] = rset($this->db->get());
				}
			}	
			return $regions;
		}
		
		
		public function getAds( $type, $id ) {
			switch ($type) {
				case 'state' : $where = 'state_id'; break;
				case 'city'  : $where = 'region_id'; break;
				case 'country' : $where = 'country_id'; break;
				case 'sponsor' : break;
			}
			
			$this->db->select('*');
			$this->db->from('ads');			
			if ($type == 'sponsor') {
				// sponsor stuff
			} else {
				$this->db->where($where, $id);
			}
			$this->db->where('ads.ad_startdate < NOW()');
			$this->db->where('ads.ad_expdate > NOW()');
			$this->db->join('company', 'ads.co_id = company.co_id');
			$this->db->order_by('ads.ad_startdate','ASC');
			
			$query = rset($this->db->get());
			
			//echo $this->db->last_query();

			return $query;
		}

		public function getStateInfo($s){

			$s=strtoupper($s);
			$this->db->select('*');
			$this->db->from('lu_state');
			$this->db->where('state_abbr', $s);

			$query = rset($this->db->get());
			return $query[0];
		}

		public function getCityInfo($c){

			$this->db->select('*');
			$this->db->from('lu_region');
			$this->db->where('region', $c);

			$query = rset($this->db->get());
			return $query[0];
		}
		
		public function getLocation( $state, $city = false ) {
			// make sure state exists
			$state = $this->getStateInfo($state);
			
			// does state exist?
			if (!$state) return false;
			else {
				if ($city !== false) {
					$city = $this->getCityInfo($city);
					// does city exist?
					if (!$city) return false;
					else {
						// return the city state info to controller
						$location['city'] = $city['region'];
						$location['state'] = strtoupper($state['state_abbr']);
						$location['region_id'] = $city['region_id'];
						$location['region'] = $this->getRegionById( $city['region_id'] );
						return $location;
					}
				} else return true;			
			}
		}
		
		public function getCityCompanies( $region_id ) {
		
			$this->db->select('*');
			$this->db->from('regionlist as rl');
			$this->db->join('company as c', 'rl.co_id = c.co_id');
			$this->db->where('rl.region_id', $region_id );
			$this->db->where('rl.regionlist_start < NOW()');
			$this->db->where('rl.regionlist_end > NOW()');
			//$this->db->order_by('rl.regionlist_premier','desc');
			$this->db->order_by('c.co_name');

			$co = rset($this->db->get());
			
			$this->db->flush_cache();
			
			for ($i=0; $i < count($co); $i++) {
				$this->db->select('*');
				$this->db->from('company_category as cc');
				$this->db->join('lu_category as cat', 'cc.cat_id = cat.cat_id');
				$this->db->where('cc.co_id', $co[$i]['co_id']);
				$co[$i]['categories'] = rset($this->db->get());
			}
			return $co;
		
		}
		
		
		public function getRegionById( $rid ) {
			$this->db->select('*');
			$this->db->from('lu_region as r');
			$this->db->join('lu_state as s', 'r.state_id = s.state_id');
			$this->db->where('r.region_id', $rid);

			$query = rset($this->db->get());
			return $query[0];
		}

	}
