<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends  
{	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->helper(array('url', 'form'));				
		$this->load->model('member_model');
		$this->load->library('form_validation');
		$this->load->database(); 
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */