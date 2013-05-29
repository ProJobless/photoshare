<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Form Validation
|--------------------------------------------------------------------------
| Our form validation configuration. 
|
*/

$config = array(
	'welcome/login' => array(
		array (
			'field'	=> 'log_username',
			'label'	=> 'Username',
			'rules'	=> 'required|alpha_numeric'
		),
		array (
			'field'	=> 'log_password',
			'label'	=> 'Password',
			'rules'	=> 'required'
		)
	),
	
	'welcome/register'	=> array(
		array(	
			'field'	=> 'reg_username',
			'label'	=> 'Username',
			'rules'	=> 'required|min_length[6]|max_length[20]|alpha_numeric|is_unique[members.username]'
		),
		array (
			'field'	=> 'reg_password',
			'label'	=> 'Password',
			'rules'	=> 'required|min_length[8]|max_length[16]|callback__password_check'
		),
		array (
			'field'	=> 'first_name',
			'label'	=> 'First name',
			'rules'	=> 'required|min_length[2]|max_length[40]|callback__name_check'
		),
		array (
			'field'	=> 'last_name',
			'label'	=> 'Last name',
			'rules'	=> 'required|min_length[2]|max_length[40]|callback__name_check'
		),
		array (
			'field'	=> 'email',
			'label'	=> 'Email',
			'rules'	=> 'required|valid_email|is_unique[members.email]'
		)
	)
);