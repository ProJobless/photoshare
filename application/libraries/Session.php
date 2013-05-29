<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter library utilizing PHP native sessoin with database
 *
 * @package     Session
 * @subpackage  Libraries
 * @category    Session
 * @author    	Zakir Tariverdiev   
 */

/**
 * Test if valid user is attempting the login
 *
 * @access	public
 * @param	array
 * @return	bool
 */
 
class Session
{
	protected $ci = NULL;
	protected $config = array();
	protected $session_id = NULL;
	
	public function __construct() 
	{
		$this->ci = get_instance();						
		
		// We'll use custom session handlers that are methods of this class for all session operations	
		// For examples on how session handlers can be used, please visit this page:
		// http://shiflett.org/articles/storing-sessions-in-a-database
		session_set_save_handler(
			array($this, 'open'),
			array($this, 'close'),
			array($this, 'read'),
			array($this, 'write'),			
			array($this, 'destroy'),
			array($this, 'gc')
		);
		
		// Create the session
		if ( ! isset($_SESSION))
		{
			session_start();
		}
		
	}
	
   /**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/
	public function open()
	{
		// Copy relevant session configuraiton items for our own use
		$this->config['sess_expiration'] 	  = $this->ci->config->item('sess_expiration');
		$this->config['sess_use_database'] 	  = $this->ci->config->item('sess_use_database');
		$this->config['sess_table_name']   	  = $this->ci->config->item('sess_table_name');
		$this->config['sess_match_useragent'] = $this->ci->config->item('sess_match_useragent');
		$this->config['sess_time_to_update']  = $this->ci->config->item('sess_time_to_update');
		
		/*
		// If storing session in the database option was chosen...
		if ($this>config['sess_use_database'] && $this->config['sess_table_name'] != '')
		{			
			$this->ci->load->database();
						
		}
		*/
	}
	
	/**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/
	public function close()
	{
		// Not currently implemented
	}	
	
	/**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/
	public function read($id) 
	{		
		if (is_string($id))
		{
			if ($this->config['sess_use_database'] && $this->config['sess_table_name'] != '')
			{			
				$this->ci->load->database();
				$query = $this->ci->db->select('user_data')
									  ->from($this->config['sess_table_name'])
							 		  ->where('session_id', $id)
							 		  ->get();
				
				if ($query->num_rows() > 0)
				{
					$row = $query->row();
					echo $row->user_data;
					return $row->user_data;
				}
			}
		} 
	}
	
   /**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/	
	public function write($id, $data)
	{		
		if (is_string($id) && is_string($data))
		{
			if ($this->config['sess_use_database'] && $this->config['sess_table_name'] != '')
			{
				$this->ci->load->database();								
				
				$query = $this->ci->db->select('user_data')
							 	 	  ->from($this->config['sess_table_name'])
							 		  ->where('session_id', $id)
									  ->get();
				
				$session_data = array(
					'session_id' => $id,
					'user_data'	 => $data
				);
		
				
				// Record with this session ID already exists
				if ($query->num_rows() > 0)
				{
					// Replace it with new data
					$this->ci->db->where('session_id', $id)
								 ->update($this->config['sess_table_name'], $session_data);
				}				
				// No previous record of this session exists
				else
				{
					// So create a new one
					
					$this->ci->db->insert($this->config['sess_table_name'], $session_data);
				}
				
				/* MySQL DB driver only
				$this->db->protect_identifiers($this->config['sess_table_name']);
				
				// MySQL escape all data
				$id = $this->ci->db->escape($id);
				*/
			}
		}
	}
	
   /**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/
	public function destroy($id)
	{
		if (is_string($id))
		{
			if ($this->config['sess_use_database'] && $this->config['sess_table_name'] != '')
			{
				// Delete the session record from the database
				$this->ci->load->database();
				$this->ci->db->where('session_id', $id)
							 ->delete($this->config['sess_table_name']);
			}
		}
	}
	
   /**
 	* Test if valid user is attempting the login
 	*
 	* @access	public
 	* @param	array
 	* @return	bool
 	*/
	public function gc($id)
	{
		// Clean all records code goes here...
	}
	
	public function set_userdata($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{				
				$_SESSION[$key] = $val;				
			}
		}
		else
		{
			
		}
	}
	
	public function userdata($data)
	{
		if (isset($_SESSION[$data]))
		{
			return $_SESSION[$data];
		}
				
		return FALSE;
	}
	
	public function sess_destroy()
	{
		session_destroy();
	}
	
	public function unset_userdata($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (isset($_SESSION[$data]))
				{
					unset($_SESSION[$key]);
				}
			}
		}
		else
		{
			if (isset($_SESSION[$data]))
			{
				unset($_SESSION[$data]);
			}
		}
	}
}
/* End of file session.php */
/* Location: ./application/libraries/session.php */