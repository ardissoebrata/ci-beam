<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Show welcome message.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Welcome extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('welcome');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *  - or -
	 *		http://example.com/index.php/welcome/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->template->load_module_partial('sections', 'welcome/hmvc/section_partial')
			->build('welcome_message');
	}
	
	/**
	 * Show Twitter Bootstrap demo pages.
	 * 
	 * @param string @page Page name ('starter', 'marketing', 'fluid')
	 * @see http://twitter.github.com/bootstrap/index.html 
	 */
	public function bootstrap_demo($page = 'starter')
	{
		if ($page == 'fluid')
		{
			$this->template->set_layout('fluid')
				->load_module_partial('sidebar', 'welcome/hmvc/sidebar_partial');
		}
		$this->template->build('bootstrap_' . $page);
	}
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */