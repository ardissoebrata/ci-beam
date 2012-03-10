<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

/* End of file logout.php */
/* Location: ./application/modules/auth/controllers/logout.php */