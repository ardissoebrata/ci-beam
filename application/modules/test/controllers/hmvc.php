<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Test controller.
 * 
 * @package App
 * @author Ardi Soebrata 
 */
/**
 * Test HMVC functionality.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Hmvc extends CI_Controller 
{
	
	public function hierarchy() 
	{
		log_message('debug', 'Test/Hmvc/hierarchy Loaded.');
		$this->load->view('test/hmvc_hierarchy');
	}
	
	public function partial() 
	{
		$this->load->view('test/partial');
	}
}

/* End of file hmvc.php */
/* Location: ./application/modules/test/controllers/hmvc.php */