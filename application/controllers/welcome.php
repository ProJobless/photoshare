<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->helper(array('url', 'form'));				
		$this->load->model('member_model');
		$this->load->library(array('form_validation', 'session'));		
		$this->load->database(); 				
	}
	
	public function index()
	{			
		$data['main'] = 'welcome/login_register';
		$data['title'] = 'Login/Register';
		//$data['session_id'] = $this->session->userdata('session_id');
		$this->load->view('template', $data);		
	}
	
	public function login()
	{			
		// Validate the login form
		if ( ! $this->form_validation->run())
		{
			// The form validaiton failed so display the login form again, but w/errors
			$data['main'] = 'welcome/login_register';
			$data['title'] = 'Login/Register';
			$this->load->view('template', $data);		
		}	
		else
		{
			// We got through the form validation, so now let's look for the user in the DB 
			$input = array(
				'username' => $this->input->post('log_username', TRUE),
				'password' => $this->input->post('log_password', TRUE)
			);
							
			$member = $this->member_model->validate_member($input);			
			if ($member !== FALSE)
			{
				// User exists, so produce welcome message
				$user_data = array(
					'username'	=> $member->username,
					'email'		=> $member->email,
					'logged_in' => TRUE
				);
				
				//$this->load->library('session');							
				$this->session->set_userdata($user_data);								
				redirect('/member/');				
			}
			else
			{
				// Display the form with the error			
				$data['main'] = 'welcome/login_register';
				$data['title'] = 'Login/Register';
				$data['invalid_user_error'] = 'Invalid username/password';
				$this->load->view('template', $data);	
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
		else
		{
			$this->member_model->create_member($_POST);
		}
	}
		
	public function _password_check($pwd)
	{
		// Each password must contain at least one lower-case letter, one upper-case letter,
		// one digit, and one symbol specified in $valid_symbols
		// For more info on regular expressions and "look-ahead" visit this page:
		// http://www.regular-expressions.info/completelines.html
		$valid_symbols = '-_\^!@#$%&*+=';
		$sub_exp = "[$valid_symbols" . 'a-zA-Z0-9]';
		$exp = "/^(?=$sub_exp*?[A-Z])(?=$sub_exp*?[a-z])(?=$sub_exp*?[0-9])(?=$sub_exp*?[$valid_symbols])$sub_exp*$/";

		if ( ! preg_match($exp, $pwd))
		{
			$this->form_validation->set_message('_password_check', 
			'The %s field must contain at least one of the following lower-case letter, upper-case letter, digit, and !@#$%^&*()-_+=');
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function _name_check($name) 
	{
		// The name must start with a letter and can contain letters, spaces, ', and - only
		if ( ! preg_match('/^[a-z][ \s\'-a-z]+$/i', $name))
		{
			$this->form_validation->set_message('_name_check', 'The %s field may contain letters, spaces, \', and - only');
			return FALSE;
		}
		
		return TRUE;
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */