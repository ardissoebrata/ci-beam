<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Charts controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Charts extends Admin_Controller {

	public function flot()
	{
		$this->template
				->set_js('../bower_components/flot/excanvas.min', TRUE)
				->set_js('../bower_components/flot/jquery.flot', TRUE)
				->set_js('../bower_components/flot/jquery.flot.pie', TRUE)
				->set_js('../bower_components/flot/jquery.flot.resize', TRUE)
				->set_js('../bower_components/flot/jquery.flot.time', TRUE)
				->set_js('../bower_components/flot.tooltip/js/jquery.flot.tooltip.min', TRUE)
				->set_js('flot-data', TRUE)
				->build('samples/charts/flot');
	}

	public function morris()
	{
		$this->template
				->set_js('../bower_components/raphael/raphael.min', TRUE)
				->set_js('../bower_components/morrisjs/morris.min', TRUE)
				->set_js('morris-data', TRUE)
				->build('samples/charts/morris');
	}

}
