<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
            redirect($this->config->item('dashboard_uri'));
        }
		
		$this->load->language('auth');
		
        // form submitted
        if ($this->input->post('username') && $this->input->post('password')) 
		{
            $remember = $this->input->post('remember') ? TRUE : FALSE;
            
            // get user from database
			$query = $this->doctrine->em->createQuery('SELECT u FROM auth\models\User u WHERE u.username = :username')
					->setParameter('username', $this->input->post('username'));
			try
			{
				$user = $query->getSingleResult();
				
				// compare passwords
				if ($user->check_password($this->input->post('password')))
				{
                    // mark user as logged in
                    $this->auth->login($user->getId(), $remember);
					
					$this->load->model(array('acl/role_model'));
					$role = $this->role_model->get_by_id($user->getRoleId());
					
					$ci = &get_instance();
					$ci->session->set_userdata(array('role' => $role->name));
					
                    redirect($this->config->item('dashboard_uri'));
                }
				else
                    throw new Exception(lang('login_failed'));
			}
			catch (Exception $e)
			{
				$this->data['error'] = lang('login_attempt_failed');
			}
        }
		
		if ($this->input->post('username'))
			$this->data['username'] = $this->input->post('username');
		if ($this->input->post('remember'))
			$this->data['remember'] = $this->input->post('remember');
        
        // show login form
        $this->load->helper('form');
		$this->template->set_layout('no-footer')->build('login');
	}
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */