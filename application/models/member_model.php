<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();		
	}
	
	/**
 	* Checks if the user already exists in the database
 	*
 	* @access	public
	* @param	void
 	* @return	void
	*/
	public function create_member(array $input)
	{
		$data['username'] = $input['username'];
		$data['email']  = $this->input->post('email');
		
		if ($this->user_exists($data['username'], $data['email']))
		{
			return 'Username/email already taken';
		}
		
		$data['first_name'] = $input['first_name'];
		$data['last_name'] = $input['last_name'];
		$data['password'] = $this->hash_password($input['password'],
												substr(sha1(mt_rand()), 0, 22));		
		$this->db->insert('members', $data);
	}
	
	public function validate_member(array $input)
	{
		$query = $this->db->select('username, password, email, first_name, last_name, date_created')
				 		  ->from('members')
				 		  ->where('username', $input['username'])
						  ->get();
						  
		if ($query->num_rows() <= 0)				  	
		{
			return FALSE;
		}
		
		$row = $query->row();		
		
		$full_salt = substr($row->password, 0, 29);
		$new_hash = $this->hash_password($input['password'], $full_salt);
						
		if ($new_hash !=  $row->password) 
		{
			return FALSE;
		}
			
		return $row;	
	}	
	
	/**
 	* Checks if the user already exists in the database
 	*
 	* @access	private
	* @param	string $username
	* @param 	string $email 
 	* @return	int
	*/
	private function user_exists($username, $email)
	{		 
		return $this->db->from('members')
				 		->where('username', $username)
				 		->or_where('email', $email)
				 		->count_all_results();
		
	}
	
	private function hash_password($password, $salt) 
	{
		return crypt($password, $salt);
	}
}
/* End of file user_model.php */
/* Location: ./application/models/user_model.php */