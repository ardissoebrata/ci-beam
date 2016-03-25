<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Controller for authenticate controllers.
 * 
 * @package CI-Beam
 * @category Controller
 * @author Ardi Soebrata
 */
class Admin_Controller extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->auth->loggedin())
			redirect('auth/login?redirect=' . current_url());
		
		$this->template->set_layout('admin');
	}
}