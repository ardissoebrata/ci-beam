<?php
/*
 * Sign_out Controller
 */
class Sign_out extends AccountBaseController {
	
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		// Load the necessary stuff...
		$this->load->language(array('account/sign_out'));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Account sign out
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect signed out users to homepage
		if ( ! $this->authentication->is_signed_in()) redirect('');
		
		// Run sign out routine
		$this->authentication->sign_out();
		
		// Redirect to homepage
		if ( ! $this->config->item("sign_out_view_enabled")) redirect('');
		
		// Load sign out view
		$this->template->set_content('sign_out');
        $this->template->build();
	}
	
}


/* End of file sign_out.php */
/* Location: ./application/modules/account/controllers/sign_out.php */