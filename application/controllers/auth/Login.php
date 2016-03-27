<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Login extends MY_Controller 
{
	function index()
	{
		// user is already logged in
        if ($this->auth->loggedin()) 
		{
            redirect($this->config->item('dashboard_uri', 'template'));
        }
		
		$this->load->language('auth');
		$username = $this->input->post('username', FALSE);
		$password = $this->input->post('password', FALSE);
		$remember = $this->input->post('remember') ? TRUE : FALSE;
		$redirect = $this->input->get_post('redirect');
		
        // form submitted
        if ($username && $password) 
		{
            // get user from database
			$user = $this->user_model->get_by_username($username);
			if ($user && $this->user_model->check_password($password, $user->password))
			{
				// mark user as logged in
				$this->auth->login($user->id, $remember);
				
				// Add session data
				$this->session->set_userdata(array(
					'lang'		=> $user->lang,
					'role_id'	=> $user->role_id,
					'role_name'	=> $user->role_name
				));
				
				if ($redirect)
					redirect($redirect);
				else
					redirect($this->config->item('dashboard_uri', 'template'));
			}
			else
				$this->template->add_message ('error', lang('login_attempt_failed'));
        }
		else
		{
			if (($username === '') || ($password === ''))
				$this->template->add_message('error', lang('username_or_password_empty'));
		}
		
		$data = array();
		if ($username)
			$data['username'] = $username;
		if ($remember)
			$data['remember'] = $remember;
        
        // show login form
        $this->load->helper('form');
		$this->template->set_layout('clean')
				->build('auth/login', $data);
	}
}
