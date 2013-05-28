<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends User_Controller 
{
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function index()
	{
		
	}
	
	public function upload() 
	{
		$this->load->helper('form');		
		
		if (isset($_FILES['photo']))
		{
			$this->_upload_photo();	
		}
		
		$data['main'] = 'photo/upload';
		$data['title'] = 'Upload Photo';
		$this->load->view('template', $data);					
	}
	
	public function edit()
	{
	}
	
	public function delete()
	{
	}
	
	private function _upload_photo() 
	{
		// Prepare the file's configuration
		$config['upload_path'] = IMG_UPLOADS_PATH;
		$config['allowed_types'] = ALLOWED_IMG_TYPES;
		$config['max_size'] = MAX_IMG_SIZE;
		$config['max_width'] = MAX_IMG_WIDTH;
		$config['max_height'] = MAX_IMG_HEIGHT;
		$config['max_filename'] = MAX_FILENAME_SIZE;
		$config['remove_spaces'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('photo'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->vars($error);
		}
		else
		{
			$error = '';
			$this->load->vars($error);
		}
	}
}

/* End of file photo.php */
/* Location: ./application/controllers/photo.php */