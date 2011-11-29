<?php
/*
 * Account_password Controller
 */
class Account_password extends AdminController {
	
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		// Load the necessary stuff...
		$this->load->helper(array('date'));
        $this->load->library(array('form_validation'));
		$this->load->language(array('account/account_password'));
	}
	
	/**
	 * Account password
	 */
	function index()
	{
		// No access to users without a password
		if ( ! $this->data['account']->password) redirect('');
		
		### Setup form validation
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		$this->form_validation->set_rules(array(
			array('field'=>'password_new_password', 'label'=>'lang:password_new_password', 'rules'=>'trim|required|min_length[6]'),
			array('field'=>'password_retype_new_password', 'label'=>'lang:password_retype_new_password', 'rules'=>'trim|required|matches[password_new_password]')
		));
		
		### Run form validation
		if ($this->form_validation->run()) 
		{
			// Change user's password
			$this->account_model->update_password($this->data['account']->id, $this->input->post('password_new_password'));
			$this->session->set_flashdata('success', lang('password_password_has_been_changed'));
			redirect('account/account_password');
		}
	
		$this->data['current'] = 'account_password';
		$this->data['page_menu'] = $this->load->view('account/account_menu', $this->data, TRUE);
		
		$this->template->set_page_title(lang('password_page_name'));
		$this->template->set_content('account/account_password', $this->data);
		$this->template->build();
	}
	
}


/* End of file account_password.php */
/* Location: ./application/modules/account/controllers/account_password.php */