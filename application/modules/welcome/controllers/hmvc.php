<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Test HMVC and Partials functionality.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Hmvc extends MY_Controller 
{
	/**
	 * Display module::run example. 
	 */
	public function module_run()
	{
		$this->load->view('welcome/module_run');
	}
	
	/**
	 * Display section partial example.
	 */
	public function section_partial()
	{
		$this->load->view('welcome/section_partial');
	}
	
	/**
	 * Display sidebar partial example. 
	 */
	public function sidebar_partial() 
	{
		$this->load->view('welcome/sidebar_partial');
	}
}

/* End of file hmvc.php */
/* Location: ./application/modules/welcome/controllers/hmvc.php */