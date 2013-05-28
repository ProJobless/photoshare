<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller 
{	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->helper(array('url', 'form'));				
		$this->load->model('member_model');
		$this->load->library('form_validation');
		$this->load->database(); 
	}
	
	public function index()
	{
		redirect('welcome', 'location', 301);						
	}
	
	public function login()
	{			
		// Validate the login form
		if ( ! $this->form_validation->run())
		{
			// Take user back to the form with errors
			$data['main'] = 'welcome/login_register';
			$data['title'] = 'Login/Register';
			$this->load->view('template', $data);		
		}	
		else
		{
			$input = array(
				'username' => $this->input->post('log_username'),
				'password' => $this->input->post('log_password')
			);
							
			$member = $this->member_model->validate_member($input);
			if ($member !== FALSE)
			{
				echo 'Welcome ' .  $member->username;
			}
		}
	}
	
	public function register()
	{	 			
			// Validate the login form
		if ( ! $this->form_validation->run())
		{
			// Take user back to the form with errors
			$data['main'] = 'welcome/login_register';
			$data['title'] = 'Login/Register';
			$this->load->view('template', $data);			
		}
	}
	
	public function password_check($pwd)
	{
		if ( ! preg_match('/^[-_+*&$#@!a-z0-9]+$/i', $pwd))
		{
			$this->form_validation->set_message('password_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		
		return TRUE;
	}
}
/* End of file user.php */
/* Location: ./application/controllers/user.php */