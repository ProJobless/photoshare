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
		$data['username'] = $this->security->xss_clean($input['reg_username']);
		$data['email'] = $this->security->xss_clean($input['email']);
		
		if ($this->user_exists($data['username'], $data['email']))
		{
			return 'Username/email already taken';
		}
	
		// Copy all data field by field from the input (POST)		
		$data['first_name'] = $this->security->xss_clean($input['first_name']);
		$data['last_name'] = $this->security->xss_clean($input['last_name']);
		
		// Hash the pass password before storing in DB
		$data['password'] = $this->security->xss_clean($input['reg_password']);
		$data['password'] = $this->hash_password($data['password'],
												substr(sha1(mt_rand()), 0, 22));		
		
		// Create new DB record
		$this->db->insert('members', $data);
	}
	
	/**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
	* @param	array
 	* @return	bool
	*/
	public function validate_member(array $input)
	{
		// Pull all user data from the DB associated with the username
		$query = $this->db->select('username, password, email, first_name, last_name, date_created')
				 		  ->from('members')
				 		  ->where('username', $input['username'])
						  ->get();
								  
		// No such user in the DB				  
		if ($query->num_rows() <= 0)				  	
		{
			return FALSE;
		}
		
		// Username exists, so let's check if the entered password matches DB version as well
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