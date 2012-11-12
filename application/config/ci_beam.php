<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Default number of rows to display on data tables 
 * 
 */
$config['rows_limit']		= 20;

/*
 * Supported Languages
 * 
 */
$config['languages']		= array(
	'en' => array('name' => 'English', 'folder' => 'english'),
	'id' => array('name' => 'Bahasa Indonesia', 'folder' => 'indonesian')
);

/**
 * Main Navigation.
 * Primarily being used in views/navbar.php
 * 
 */
$config['main_nav']			= array(
	'welcome/bootstrap_demo/starter'	=> 'Starter',
	'welcome/bootstrap_demo/fluid'		=> 'Fluid',
	'welcome/bootstrap_demo/marketing'	=> 'Marketing',
	'auth/user'							=> 'User',
	'acl'								=> array(
		'acl/rule'		=> 'Rules',
		'acl/role'		=> 'Roles',
		'acl/resource'	=> 'Resources'
	)
);