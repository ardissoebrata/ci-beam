<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Logout controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Logout extends MY_Controller 
{
	function index()
	{
		$this->auth->logout();
		redirect('/');
	}
}
