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
	}
	
	function index()
	{
		/**
		 * @var \Doctrine\ORM\Query 
		 */
		$query = $this->doctrine->em->createQuery('SELECT u FROM auth\models\user u');
		$users = $query->getArrayResult();
		
		$this->template->build('user-list', array('users' => $users));
	}
	
	function edit()
	{
		$this->load->helper('form');
		$this->template->build('user-edit');
	}
}

/* End of file auth.php */
/* Location: ./application/modules/auth/controllers/auth.php */