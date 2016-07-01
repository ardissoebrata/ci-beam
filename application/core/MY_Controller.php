<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller for public controllers.
 * 
 * @package CI-Beam
 * @category Controller
 * @author Ardi Soebrata
 * 
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_URI $uri
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
 * @property Auth $auth
 * @property Acl $acl
 * @property Template $template
 * @property User_model $user_model
 * @property Role_model $role_model
 * 
 */
class MY_Controller extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// Setting up language.
		$languages = $this->config->item('languages', 'template');
		// Lang has already been set and is stored in a session
		$lang = $this->session->userdata('lang');
		// No Lang. Lets try some browser detection then
		if (empty($lang) and !empty( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) and !empty($languages))
		{
			// explode languages into array
			$accept_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

			log_message('debug', 'Checking browser languages: '.implode(', ', $accept_langs));

			// Check them all, until we find a match
			foreach ($accept_langs as $lang)
			{
				// Turn en-gb into en
				$lang = substr($lang, 0, 2);

				// Check its in the array. If so, break the loop, we have one!
				if(in_array($lang, array_keys($languages)))
				{
					break;
				}
			}
		}
		// If no language has been worked out - or it is not supported - use the default (first language)
		if (empty($lang) or !in_array($lang, array_keys($languages)))
		{
			reset($languages);
			$lang = key($languages);
			$this->load->vars('lang', $lang);
		}
		$this->config->set_item('language', $languages[$lang]['folder']);
		$this->load->language('application');
		
		// Set redirect 
		$this->load->vars('redirect', urldecode($this->input->get_post('redirect')));
	}
}

include_once(APPPATH . '/core/Admin_Controller.php');