<?php

/**
 * Base controller for Account Module.
 */
class AccountBaseController extends CI_Controller
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('general'));
		
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));
	}
}