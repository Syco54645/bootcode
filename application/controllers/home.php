<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('post_model');
		/*$this->load->model('company_model');
		$this->load->model('dir_model');*/

		// Initialize page variables 
		$this->data = $this->tank_auth->auth_init( false, '' );
		
	}

	private $data;

	public function index( ) {
			
		
		$this->data['pageTitle'] = "";

		$sideMenu = $this->blog->generateSideMenu();
		$this->data['sideMenu']=$sideMenu;

		$this->data['blogs'] = $this->post_model->getBlogs();

		$this->load->view(THEME.'/_header', $this->data);
		$this->load->view(THEME.'/v_home', $this->data);
		$this->load->view(THEME.'/_footer', $this->data);
	
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */