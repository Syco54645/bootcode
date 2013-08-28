<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message:: a crap class for sending messages via the session. frank had to rewrite this shitty ass code.
 *
 * @version 1.0
 */

class Messages
{
    public function msg($m){
        // get the superobject
        $CI =& get_instance();
        $om = $CI->session->userdata('msg');
        if(count($om) == 1){
            settype($om, "array"); 
        }
        
        array_push($om, $m);
        $CI->session->set_userdata('msg', $om);
    }

    public function showMsg(){
        $CI =& get_instance();
        $ct=count($CI->session->userdata('msg'));
        if($ct>1){
            echo "<div class='message success'>";
            for($i=0; $i<$ct; $i++){
                $arr=$CI->session->userdata('msg');
                if(strlen($arr[$i])!=0){
                    echo $arr[$i]."<br />";    
                }
            }
            echo "</div>";
        }
        $CI->session->unset_userdata('msg');
    }

    public function err($m){
        // get the superobject
        $CI =& get_instance();
        $om = $CI->session->userdata('err');
        if(count($om) == 1){
            settype($om, "array"); 
        }
        
        array_push($om, $m);
        $CI->session->set_userdata('err', $om);
    }

    public function showErr(){
        $CI =& get_instance();
        $ct=count($CI->session->userdata('err'));
        if($ct>1){
            echo "<div class='message errors'>";
            for($i=0; $i<$ct; $i++){
                $arr=$CI->session->userdata('err');
                if(strlen($arr[$i])!=0){
                    echo $arr[$i]."<br />";    
                }
            }
            echo "</div>";    
        }
        
        $CI->session->unset_userdata('err');
    }
}