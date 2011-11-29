<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class AdminController extends BaseController
{
	function __construct()
	{
		parent::__construct();
		
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in()) 
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().$this->uri->uri_string()));
		}
		
		// Retrieve sign in user
		$this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
	}
}