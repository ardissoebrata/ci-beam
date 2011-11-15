<?php

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		
		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
        $this->load->library(array('account/authentication'));
		$this->load->model(array('account/account_model'));
		$this->lang->load(array('general'));
	}
	
	function index()
	{
		maintain_ssl();
		
		$data = array();
		
		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		
        $this->template->add_message('success', 'You are using duellsys template library');
        $this->template->add_message('info', 'Awesome!');

        $this->template->set_content('home', $data);
        $this->template->build();
	}
	
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */