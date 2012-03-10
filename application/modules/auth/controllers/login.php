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
            redirect('/auth/user');
        }
		
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
                    redirect('/auth/user');
                }
				else
                    throw new Exception('Login failed!');
			}
			catch (Exception $e)
			{
				$this->data['error'] = 'Login attempt failed!';
			}
        }
		
		if ($this->input->post('username'))
			$this->data['username'] = $this->input->post('username');
		if ($this->input->post('remember'))
			$this->data['remember'] = $this->input->post('remember');
        
        // show login form
        $this->load->helper('form');
		$this->template->build('login');
	}
}

/* End of file login.php */
/* Location: ./application/modules/auth/controllers/login.php */