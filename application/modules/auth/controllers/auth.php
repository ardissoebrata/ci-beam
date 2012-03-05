<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authentication controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Auth extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->spark('beam-template/0.0.1');
	}
	
	function index()
	{
		$this->template->build('user-list');
	}
	
	function edit()
	{
		$this->load->helper('form');
		$this->template->build('user-edit');
	}
}

/* End of file auth.php */
/* Location: ./application/modules/auth/controllers/auth.php */