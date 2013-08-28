<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('post_model');
		
		// Initialize page variables 
		$this->data = $this->tank_auth->auth_init( false, '' );
		
	}

	private $data;

	public function index() {
			
		$this->data['pageTitle'] = "";

		$sideMenu = $this->blog->generateSideMenu();
		$this->data['sideMenu']=$sideMenu;

		$this->data['page'] = $this->post_model->getPostFromSlug(end($this->uri->segment_array()));

		$this->load->view(THEME.'/_header', $this->data);
		$this->load->view(THEME.'/v_page', $this->data);
		$this->load->view(THEME.'/_footer', $this->data);
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */