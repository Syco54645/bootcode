<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_options{

	function __construct(){
		/*
		|
		| this is where we set up blog constants. take it or leave it!!!
		|
		*/

		define('THEME', $this->getTheme());
		define('SITENAME', $this->getName());
		define('SITEURL', $this->getUrl());
		define('TAGLINE', $this->getTagline());
	}

	public function getUrl(){
		// get the superobject
		$CI =& get_instance();
		$CI->load->model('options_model');

		return $CI->options_model->returnOption('site_address');
	}

	public function getName(){
		// get the superobject
		$CI =& get_instance();
		$CI->load->model('options_model');

		return $CI->options_model->returnOption('site_name');
	}

	public function getTagline(){
		// get the superobject
		$CI =& get_instance();
		$CI->load->model('options_model');

		return $CI->options_model->returnOption('tagline');
	}

	public function getTheme(){
		// get the superobject
		$CI =& get_instance();
		$CI->load->model('options_model');

		$theme=$CI->options_model->returnOption('theme');
		if($theme=="default"){
			$theme="";
		}
		return $theme;
	}

}