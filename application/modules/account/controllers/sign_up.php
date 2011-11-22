<?php
/*
 * Sign_up Controller
 */
class Sign_up extends AccountBaseController {
	
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		// Load the necessary stuff...
        $this->load->library(array('account/recaptcha', 'form_validation'));
		$this->load->model(array('account/account_details_model'));
		$this->lang->load(array('account/sign_up', 'account/connect_third_party'));
	}
	
	/**
	 * Account sign up
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');
		
		// Check recaptcha
		$recaptcha_result = $this->recaptcha->check();
		
		// Store recaptcha pass in session so that users only needs to complete captcha once
		if ($recaptcha_result === TRUE) $this->session->set_userdata('sign_up_recaptcha_pass', TRUE);
		
		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		$this->form_validation->set_rules(array(
			array('field'=>'sign_up_username', 'label'=>'lang:sign_up_username', 'rules'=>'trim|required|alpha_dash|min_length[2]|max_length[24]|callback_username_check'),
			array('field'=>'sign_up_password', 'label'=>'lang:sign_up_password', 'rules'=>'trim|required|min_length[6]'),
			array('field'=>'sign_up_email', 'label'=>'lang:sign_up_email', 'rules'=>'trim|required|valid_email|max_length[160]|callback_email_check')
		));
		
		// Run form validation
		if ($this->form_validation->run() === TRUE) 
		{
			// Either already pass recaptcha or just passed recaptcha
			if ( ! ($this->session->userdata('sign_up_recaptcha_pass') == TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_up_recaptcha_enabled") === TRUE)
			{
				$data['sign_up_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_up_recaptcha_incorrect') : lang('sign_up_recaptcha_required');
			}
			else 
			{
				// Remove recaptcha pass
				$this->session->unset_userdata('sign_up_recaptcha_pass');
				
				// Create user
				$user_id = $this->account_model->create($this->input->post('sign_up_username'), $this->input->post('sign_up_email'), $this->input->post('sign_up_password'));
				
				// Add user details (auto detected country, language, timezone)
				$this->account_details_model->update($user_id);
				
				// Auto sign in?
				if ($this->config->item("sign_up_auto_sign_in"))
				{
					// Run sign in routine
					$this->authentication->sign_in($user_id);
				}
				redirect('account/sign_in');
			}
		}
		
		// Load recaptcha code
		if ($this->config->item("sign_up_recaptcha_enabled") === TRUE)
			if ($this->session->userdata('sign_up_recaptcha_pass') != TRUE) 
				$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));
		
		// Load sign up view
		$this->template->set_page_title(lang('sign_up_page_name'));
		$this->template->set_content('sign_up', isset($data) ? $data : NULL);
        $this->template->build();
	}
	
	/**
	 * Check if a username exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function username_check($username)
	{
		if ($this->account_model->get_by_username($username)) 
		{
			$this->form_validation->set_message('username_check', lang('sign_up_username_taken'));
			return FALSE;
		} 
		else
			return TRUE;
	}
	
	/**
	 * Check if an email exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function email_check($email)
	{
		if ($this->account_model->get_by_email($email))
		{
			$this->form_validation->set_message('email_check', lang('sign_up_email_exist'));
			return FALSE;
		}
		else
			return TRUE;
	}
	
}


/* End of file sign_up.php */
/* Location: ./application/modules/account/controllers/sign_up.php */