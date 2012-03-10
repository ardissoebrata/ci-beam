<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base controller for public controllers.
 * 
 * @package CI-Beam
 * @category Controller
 * @author Ardi Soebrata
 * 
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property MY_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Table $table
 * @property CI_Session $session
 * @property CI_FTP $ftp
 * @property CI_Pagination $pagination
 * 
 * @property Template $template
 * @property Doctrine $doctrine
 * 
 */
class MY_Controller extends CI_Controller 
{
	/**
	 * View's Data
	 * 
	 * @var array 
	 */
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->auth->loggedin())
		{
			// get current user id
			$id = $this->auth->userid();

			// get user from database
			$user = $this->doctrine->em->find('auth\models\User', $id);
			$this->data['auth_user'] = array(
				'id'			=> $user->getId(),
				'first_name'	=> $user->getFirstName(),
				'last_name'		=> $user->getLastName(),
				'username'		=> $user->getUsername(),
				'email'			=> $user->getEmail()
			);
		}
	}
}