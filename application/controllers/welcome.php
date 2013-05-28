<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('form');
		
		$data['main'] = 'welcome/login_register';
		$data['title'] = 'Login/Register';
		$this->load->view('template', $data);		
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */