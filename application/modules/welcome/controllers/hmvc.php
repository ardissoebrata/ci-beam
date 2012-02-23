<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Hmvc controller.
 * 
 * @package App
 * @author Ardi Soebrata 
 */
/**
 * Test HMVC and Partials functionality.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Hmvc extends CI_Controller 
{
	public function module_run()
	{
		$this->load->view('module_run');
	}
	
	public function section_partial()
	{
		$this->load->view('section_partial');
	}
	
	public function sidebar_partial() 
	{
		$this->load->view('sidebar_partial');
	}
}

/* End of file hmvc.php */
/* Location: ./application/modules/welcome/controllers/hmvc.php */