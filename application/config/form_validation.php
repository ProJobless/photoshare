<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'member/login' => array(
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
	
	'member/register'	=> array(
		array(	
			'field'	=> 'reg_username',
			'label'	=> 'Username',
			'rules'	=> 'required|is_unique[members.username]'
		),
		array (
			'field'	=> 'reg_password',
			'label'	=> 'Password',
			'rules'	=> 'required|min_length[8]|max_length[16]|callback_password_check'
		),
		array (
			'field'	=> 'first_name',
			'label'	=> 'First name',
			'rules'	=> 'required'
		),
		array (
			'field'	=> 'last_name',
			'label'	=> 'Last name',
			'rules'	=> 'required'
		),
		array (
			'field'	=> 'email',
			'label'	=> 'Email',
			'rules'	=> 'required|valid_email|is_unique[members.email]'
		)
	)
);