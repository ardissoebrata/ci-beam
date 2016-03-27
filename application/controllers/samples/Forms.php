<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Forms controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Forms extends Admin_Controller {

	public function index()
	{
		$this->template->build('samples/forms');
	}

}
