<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ui_elements controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Ui_elements extends Admin_Controller {

	public function panels_wells()
	{
		$this->template->build('samples/ui_elements/panels_wells');
	}
	
	public function buttons()
	{
		$this->template
				->set_css('../bower_components/bootstrap-social/bootstrap-social')
				->build('samples/ui_elements/buttons');
	}

	public function notifications()
	{
		$this->template
				->set_js_script('
    // tooltip demo
    $(\'.tooltip-demo\').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
				')
				->build('samples/ui_elements/notifications');
	}
	
	public function typography()
	{
		$this->template->build('samples/ui_elements/typography');
	}
	
	public function icons()
	{
		$this->template->build('samples/ui_elements/icons');
	}
	
	public function grid()
	{
		$this->template->build('samples/ui_elements/grid');
	}
}
