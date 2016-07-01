<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tables controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Tables extends Admin_Controller {

	public function index()
	{
		$this->template
				->set_css('../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap')
				->set_js('../bower_components/datatables/media/js/jquery.dataTables.min', TRUE)
				->set_js('../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min')
				->set_js_script(' 
					$(document).ready(function() {
						$(\'#dataTables-example\').DataTable();
					});
				')
				->build('samples/tables');
	}

}
