<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Analytics{

    public function record($t, $cid, $loc=""){
        // get the superobject
        $CI =& get_instance();
        $CI->load->model('analytics_model');

        switch ($t) {
            case 'url':
                $st='u';
                break;
            case 'banner':
                $st='b';
                break;
            case 'contact':
                $st='c';
                break;
            case 'gallery':
                $st='g';
                break;
            
            default:
                # code...
                break;
        }
        
        $CI->analytics_model->record($cid, $st, $loc);
        
    }

}