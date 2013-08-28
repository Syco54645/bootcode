<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->library('messages'); 
		
	}
	
	public function index()	{
		echo '';
	}

	public function view(){
		$id = $this->tank_auth->get_user_id();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		if(!$id) redirect();

		if($this->tank_auth->is_logged_in()) {
			$data = $this->tank_auth->auth_init( true, '');
		}
		$data['pageTitle'] = "View Profile";

		
		$data['user'] = $this->user_model->getProfile($id);
		$data['company'] = $this->user_model->getCompany($id);

		$this->load->view('_header', $data);
		$this->load->view('profile/view', $data);
		$this->load->view('_footer', $data);
	}

	public function edit()
	{
		if(!$this->tank_auth->is_logged_in()) {
			//not logged in so get them out of here
			redirect('/');
		}

		if($this->tank_auth->is_logged_in()) {
			$data = $this->tank_auth->auth_init( true, '');
		}
		$data['pageTitle'] = "My Account";

		$id = $this->tank_auth->get_user_id();
		$data['user'] = $this->user_model->getProfile($id);
		$data['company'] = $this->user_model->getCompany($id);
		//pre_print_r($data);

		if(count($_POST)){
			$queryItems['uid']=$id;
			//trim the post data
			$_POST = array_map('trim', $_POST);

			//pre_print_r($_POST);
			$success=1;
			if(!$_POST['fname']){
				$success=0;
				$this->messages->err('First Name is required.');
			}

			if(!$_POST['lname']){
				$success=0;
				$this->messages->err('Last Name is required.');
			}

			if(!$_POST['email']){
				$success=0;
				$this->messages->err('Email is required.');
			}
			$this->load->helper('email');

			if(!valid_email($_POST['email'])){
				$success=0;
				$this->messages->err('Email format is invalid.');
			}

			$queryItems['fname']=$_POST['fname'];
			$queryItems['lname']=$_POST['lname'];
			$queryItems['email']=$_POST['email'];
			//pre_print_r($queryItems);

			if($success){
				$result = $this->user_model->updateProfile($queryItems);
				if(!$result){
					$this->messages->err('An error has occured with mysql.');
				}else{
					$this->messages->msg('Your profile has been edited successfully.');
					redirect('/account/edit');
				}
			}else{
				//not successful so send post variables to view to populate form
				$data['post']=array(
									'fname'=>$_POST['fname'],
									'lname'=>$_POST['lname'],
									'email'=>$_POST['email']
									);
			}
		}

		$this->load->view('_header', $data);
		$this->load->view('v_account', $data);
		$this->load->view('_footer', $data);
	}
	
	public function addons() {
		// Ensure we're in SSL
		if (!$this->config->item('ssl')) {
			redirect('https://dodamp.com/account/addons');	
		}
		
		$data = $this->tank_auth->auth_init( true, '/account/addons');
		
		$data['pageTitle'] = "My Account";
		$this->load->view('_header', $data);

		$this->load->model('allowance_model');
		
		$allowances=$this->allowance_model->getAllowance($data['userCompany']['co_id'], "c");

		$allow_count=0;
		foreach($allowances as $allowance){
			$allow_count+=$allowance['allow_count'];
		}
		
		$data['allowCount']=3+$allow_count;

		$this->load->view('v_account_addons', $data);
		$this->load->view('_footer', $data); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */