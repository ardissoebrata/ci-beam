<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base controller for public controllers.
 * 
 * @package CI-Beam
 * @category Controller
 * @author Ardi Soebrata
 * 
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
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
 * @property Doctrine\ORM\EntityManager $em
 * 
 */
class MY_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
}