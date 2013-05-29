<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller 
{	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->database(); 
		
		$this->load->library('session');
		
		$this->load->helper('url');
	}
	
	public function index() 
	{
		if ($this->session->userdata('logged_in') === TRUE)
		{
			$data['main'] = 'member/home';
			$data['title'] = 'Welcome';						
			$data['username'] = $this->session->userdata('username');
			$data['email'] = $this->session->userdata('email');
			
			//$data['session_id'] = $this->session->userdata('session_id');		
			$this->load->view('template', $data);		
		}
		else
		{
			redirect('/welcome/', 'location', 301);
		}
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
	}
}
/* End of file member.php */
/* Location: ./application/controllers/member.php */