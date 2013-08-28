<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		
		$this->load->model('admin_model');
		$this->load->library('session');
		$this->load->library('messages');
		if(!$this->tank_auth->is_admin()){
			redirect('/auth/login');
		}
		

		$this->data = $this->tank_auth->auth_init();
		$this->data['menu']=$this->blog->adminMenu();
	}

	private $data;

	public function index(){

		$this->data['pageTitle'] = "Admin Panel";

		$this->load->view('_header', $this->data);
		$this->load->view('v_admin', $this->data);
		$this->load->view('_footer', $this->data);
	}

	public function about(){

		$this->data['pageTitle'] = "Admin Panel";
		$this->load->view('_header', $this->data);
		$this->load->view('v_about', $this->data);
		$this->load->view('_footer', $this->data);
	}

	public function editPages(){
		$this->data['pageList'] = "<div class='column'>\n".$this->generatePageList()."</div>";
		$this->data['pageTitle'] = "Admin Panel";
		$this->load->view('v_admin_editPages', $this->data);
	}

	public function editPage($pid){
		$this->load->model('post_model');

		$post=$this->admin_model->getPostFromId($pid);
		$cats=$this->admin_model->getPostCategories($pid);
		$catIds=array(-100); //not sure what the problem is with array_search... have to have something in postion 0 so lets make it a crazy value!
		if(is_array($cats)){
			foreach($cats as $c){
				array_push($catIds, $c['category_id']);
			}
		}

		$this->data['post_id']=$post['post_id'];
		$this->data['title']=$post['title'];
		$this->data['content']=$post['content'];
		$this->data['status']=$post['status'];
		$this->data['slug']=$post['slug'];
		$this->data['categories'] = $this->admin_model->getCategories();
		$this->data['postCategories'] = $catIds;

		$this->data['pageTitle'] = "Admin Panel";
		//$this->load->view('_header', $this->data);
		$this->load->view('v_admin_editPage', $this->data);
		//$this->load->view('_footer', $this->data);

	}

	public function checkSlug($pn, $pid){
		$slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $pn);
		$slug = strtolower(trim($slug, '-'));
		$slug = preg_replace("/[\/_|+ -]+/", '-', $slug);
		$newSlug=$slug;
		$ct=1;

		while(!$this->admin_model->checkSlug($newSlug, $pid)){
			$newSlug=$slug.$ct;
			$ct++;
		}

		$this->admin_model->updateSlug($newSlug, $pid);

		echo $newSlug;
	}

	public function deleteCategories(){
		$this->admin_model->deleteCategories($_POST['post_id']);		
	}

	public function saveCategory(){
		$this->admin_model->saveCategory($_POST['post_id'], $_POST['category_id']);		
	}

	public function savePage(){
		print_r($_POST);
		$this->admin_model->updatePost($_POST['title'], $_POST['contents'], $_POST['status'], $_POST['post_id']);
	}

	private function generatePageList($parentId=0){
		$this->load->model('post_model');

		$posts=$this->admin_model->getPages($parentId);

		$menu="";
		
		foreach($posts as $p){
			$title=$p['title'];
			$slug=$p['slug'];
			$post_id=$p['post_id'];

			if($p['child']){
				//this has children so setup the dropdown
				$menu .= "	<div class='portlet'>\n";
				$menu .= "		<div class='portlet-header'><span class='ui-title' rel='$post_id'>$title</span></div>\n";
				$menu .= "			<div class='portlet-content'><a class='btn btn-primary btn-small'>Delete</a></div>\n";
				$menu .= "		<div class='column'>\n";
				$menu .= $this->generatePageList($p['post_id']);
				$menu .= "		</div>\n";
				$menu .= "	</div>\n";
			}else{
				$menu .= "	<div class='portlet'>\n";
				$menu .= "		<div class='portlet-header'><span class='ui-title' rel='$post_id'>$title</span></div>\n";
				$menu .= "			<div class='portlet-content'><a class='btn btn-primary btn-small'>Delete</a></div>\n";
				$menu .= "		<div class='column'>\n";
				$menu .= "		</div>\n";
				$menu .= "	</div>\n";
			}
		}
		//$menu .= "</div>\n";
		$menu .= "	<div class='column'>\n";
		$menu .= "	</div>\n";

		return $menu;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
