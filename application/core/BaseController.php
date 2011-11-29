<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class BaseController extends CI_Controller
{
	protected $data = array();
	
	function __construct()
	{
		parent::__construct();
		
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));
	}
}