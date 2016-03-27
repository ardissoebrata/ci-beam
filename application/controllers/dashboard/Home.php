<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Home extends Admin_Controller {

	public function index()
	{
		$this->template
				->set_css('timeline')
				->set_css('../bower_components/morrisjs/morris')
				->set_js('../bower_components/raphael/raphael-min', TRUE)
				->set_js('../bower_components/morrisjs/morris.min', TRUE)
				->set_js('morris-data', TRUE)
				->build('dashboard/index');
	}
}
