<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
	}
	
	public function add_photo()
	{
		
	}	
}
/* End of file photo_model.php */
/* Location: ./application/models/photo_model.php */