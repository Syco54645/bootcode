<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
	/**************************************************************************************************/
	/***** Result Set Formatting Functions ************************************************************/
	
	function rset( $q ) {
		if ($q->num_rows() >= 1) {
			$arr = array();
			for ($i=0; $i < $q->num_rows(); $i++) {
				$r = $q->result_array();
				$arr[count($arr)] = $r;		
			}
			return $arr[0];
		} else return false;
	}
	
	function qrow( $q, $row=0 ) {
		$r = rset( $q );
		if (!isset($r[$row])) return false;
		else return $r[$row];
	}
	
	function qsql( $q ) {
		if ($q->num_rows() == 0) return false;
		else {      
			$r = $q->result_array();
			$r = $r[0];
			foreach ($r as $k => $v) return $v;
		}
	}
	
	function qin( $a ) {
		$in = '(';
		for ($i=0; $i < count($a); $i++) {
			if ($i > 0) $in .= ',';
			$in .= "'".$a[$i]."'";
		}
		$in .= ')';
		return $in;
	}
	
	/**************************************************************************************************/
	/**************************************************************************************************/

?>