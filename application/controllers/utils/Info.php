<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Display Server Info
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Info extends Admin_Controller
{

	function index()
	{
		$this->template->build('utils/info');
	}

	function display_info()
	{
		phpinfo();
	}

}
