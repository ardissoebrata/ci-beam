<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blank_page controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Blank_page extends Admin_Controller {

	public function index()
	{
		$this->template->build('samples/blank_page');
	}

}
