<?php

	function stateLink( $st ) {
		return strtolower(str_replace(' ','-',trim($st)));
	}

	function cityLink( $city ) {
		return strtolower(str_replace(' ','-',trim($city)));
	}

	function cityDB( $city ) {
		return ucfirst(str_replace('-',' ',trim($city)));
	}

	function validatePhone($value){
		$value = trim($value);
		if ($value == '') {
			return TRUE;
			}else{
				if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value)){
					return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
				}else{
					return FALSE;
			}
		}
	}

    function isChecked($cb){
        if($cb == 'checked'){
            return true;
        }else{
            return false;
        }
    }

    function repairUrl($url){
        if(strlen($url)){            
            if(strtolower(substr($url, 0, 7)) != "http://" && strtolower(substr($url, 0, 8)) != "https://"){
                $url = "http://".$url;
            }
        }
        return $url;
    }

    function validUrl($url){
        $pattern = "/(((http|https):\/\/){1}([a-zA-Z0-9_-]+)(\.[a-zA-Z0-9_-]+)+([\S,:\/\.\?=a-zA-Z0-9_-]+))/is";
        if (!preg_match($pattern, $url)){
            return FALSE;
        }
        return TRUE;
    }

    function realUrl($url){
        return @fsockopen("$url", 80, $errno, $errstr, 30);
    }

    function getLatLng($add, $city, $state, $country){
        //time to get the latitude and longitude

        $address = $add." ".$city.", "." ".$state.$country;
        $address = str_replace(" ", "+", $address);

        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
        $output= json_decode($geocode);
         
        $lat = $output->results[0]->geometry->location->lat;
        $lng = $output->results[0]->geometry->location->lng;
        $arr=array(
                    "lat"=>$lat,
                    "lng"=>$lng);
        return $arr;
    }
    
    function get_selected_categories() {
	    if (!isset($_SESSION['gsc'])) {
		    $gsc['pri'] = $gsc['web'] = $gsc['soc'] = $gsc['mob'] = $gsc['seo'] = $gsc['adv'] = $gsc['pre'] = $gsc['fre'] = TRUE;
		    $_SESSION['gsc'] = $gsc;
	    } else {
		    $gsc = $_SESSION['gsc'];
	    }
	    
	    return $gsc;
    }

function select_state( $name, $id='', $selected = false, $showdc = true ) {
	$states = array('AL'=>"Alabama",  
    'AK'=>"Alaska",  
    'AZ'=>"Arizona",  
    'AR'=>"Arkansas",  
    'CA'=>"California",  
    'CO'=>"Colorado",  
    'CT'=>"Connecticut",  
    'DE'=>"Delaware",  
    'FL'=>"Florida",  
    'GA'=>"Georgia",  
    'HI'=>"Hawaii",  
    'ID'=>"Idaho",  
    'IL'=>"Illinois",  
    'IN'=>"Indiana",  
    'IA'=>"Iowa",  
    'KS'=>"Kansas",  
    'KY'=>"Kentucky",  
    'LA'=>"Louisiana",  
    'ME'=>"Maine",  
    'MD'=>"Maryland",  
    'MA'=>"Massachusetts",  
    'MI'=>"Michigan",  
    'MN'=>"Minnesota",  
    'MS'=>"Mississippi",  
    'MO'=>"Missouri",  
    'MT'=>"Montana",
    'NE'=>"Nebraska",
    'NV'=>"Nevada",
    'NH'=>"New Hampshire",
    'NJ'=>"New Jersey",
    'NM'=>"New Mexico",
    'NY'=>"New York",
    'NC'=>"North Carolina",
    'ND'=>"North Dakota",
    'OH'=>"Ohio",  
    'OK'=>"Oklahoma",  
    'OR'=>"Oregon",  
    'PA'=>"Pennsylvania",  
    'RI'=>"Rhode Island",  
    'SC'=>"South Carolina",  
    'SD'=>"South Dakota",
    'TN'=>"Tennessee",  
    'TX'=>"Texas",  
    'UT'=>"Utah",  
    'VT'=>"Vermont",  
    'VA'=>"Virginia",  
    'WA'=>"Washington",  
    'WV'=>"West Virginia",  
    'WI'=>"Wisconsin",  
    'WY'=>"Wyoming"
    );
    
    if ($showdc) {
    	$states['DC'] = "District of Columbia";
    	ksort($states);
    }
	
	$out = '<select name="'.$name.'" id="'.$id.'">';
	foreach ($states as $abr => $full) {
		$out .= '<option value="'.$abr.'"'.($selected==$abr ? ' selected="selected"' : '').'>'.$full.'</option>';
	}
	$out .= '</select>';
	return $out;
}

function select_expdate( $sel_m = false, $sel_y = false ) {
	$out = '<select name="cc_month">';
	for ($i=1; $i <= 12; $i++) 
		$out .= '<option value="'.$i.'">'.($i < 10 ? '0' : '').$i.'</option>';
	$out .= '</select>';
	$out .= '<select name="cc_year">';
	for ($i=date('Y'); $i <= (date('Y')+10); $i++) 
		$out .= '<option value="'.$i.'">'.$i.'</option>';
	$out .= '</select>';
	return $out;
}

?>