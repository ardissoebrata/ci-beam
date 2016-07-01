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
		
		// Redirect unlogged users to login page.
		if (!$this->auth->loggedin()) {
			$this->session->set_userdata('role_name', 'Guest');
			redirect('auth/login?redirect=' . current_url());
		}
		
		// Get current user id.
		$id = $this->auth->userid();

		// Get user from database
		$user = $this->user_model->get_by_id($id);
		$user_data = array(
			'id'			=> $user->id,
			'first_name'	=> $user->first_name,
			'last_name'		=> $user->last_name,
			'username'		=> $user->username,
			'email'			=> $user->email,
			'lang'			=> $user->lang,
			'role_id'		=> $user->role_id,
			'role_name'		=> $user->role_name
		);
		$this->load->vars('auth_user', $user_data);
		$this->session->set_userdata($user_data);
		
		// Check ACL
		$this->acl->build();
		$allowed = $this->acl->is_allowed($this->uri->uri_string());
		if (!$allowed) show_error(lang('error_401'), 401, lang('error_401_title'));
		
		$this->template->set_layout('admin');
	}
}