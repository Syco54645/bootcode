<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog{

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

	public function generateSideMenu($parentId=0, $parentSlug=array()){
		$CI =& get_instance();
		$CI->load->model('post_model');

		$posts=$CI->post_model->getPages($parentId);

		if(count($parentSlug)){
			//we have a dropdown menu here
			$menu = "<ul class='dropdown-menu'>";
			$class="";
		}else{
			$menu = "<ul class='nav nav-list'>";
			$class="";
		}
		foreach($posts as $p){
			$title=$p['title'];
			$pss="";
			foreach($parentSlug as $ps){
				$pss.="/".$ps;
			}
			
			$link=SITEURL.$pss."/".$p['slug'];

			if($p['child']){
				//this has children so setup the dropdown
				$menu .= "<li class='dropdown-submenu'>";
				$menu .= "<a href='$link' data-toggle='dropdown'>$title</a>";
				array_push($parentSlug, $p['slug']);
				$menu .= $this->generateSideMenu($p['post_id'], $parentSlug);
				array_pop($parentSlug); //remove the previous subpages parent. yay!
				$menu .= "</li>";
			}else{
				$menu .= "<li><a href='$link'>$title</a></li>";
			}
		}
		$menu .= "</ul>";
		
		return $menu;
	}

	public function adminBar($pageId=0){
		$CI =& get_instance();
		if($CI->tank_auth->is_logged_in()){
		?>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<a class="brand" href="/admin/about" style='margin-left:10px;'>BC</a>
					<ul class="nav">
						<?php
							if($CI->uri->rsegment(1) == "admin"){
								echo "<li><a href='/'>Visit</a></li>";
								echo "	<li><a href='#' id='pages' class='adminMenu'>Pages</a></li>";
								echo "	<li><a href='#' id='posts' class='adminMenu'>Posts</a></li>";
								echo "	<li><a href='#' id='settings' class='adminMenu'>Settings</a></li>";
							}else{
								echo "<li><a href='/admin/'>Admin</a></li>";
								if($pageId){
									echo "<li><a href='/admin/editPage/$pageId'>Edit</a></li>";
								}else{
									echo "<li><a href='/admin/blog'>Edit</a></li>";
								}
							}
						?>
						<li><a href="/auth/logout">Logout</a></li>
					</ul>
				</div>
			</div>
		<?php
		}
	}

	public function adminMenu(){
		$menu="";
		$menu.="<ul class='nav nav-list'>";
		$menu.="	<li><a href='#' id='pages' class='adminMenu'>Pages</a></li>";
		$menu.="	<li><a href='#' id='posts' class='adminMenu'>Posts</a></li>";
		$menu.="	<li><a href='#' id='settings' class='adminMenu'>Settings</a></li>";
		$menu.="	<li><a href='/admin/about' id='about' class='adminMenu'>About</a></li>";
		$menu.="</ul>";

		return $menu;
	
	}

}