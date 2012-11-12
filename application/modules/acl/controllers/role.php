<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Role extends Admin_Controller 
{
	/**
	 * Constructor
	 */
    function __construct()
    {
        parent::__construct();
		
		$this->load->library(array('form_validation'));
		$this->load->model('acl/role_model');
		$this->load->language('acl/role');
		$this->template->set_css('simple-lists');
		
		$this->data['role_tree'] = $this->role_model->get_tree();
		
		$this->data['isAjax'] = FALSE;
	}
	
	function index()
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		$this->template->set_title(lang('role_page_name'));
		$this->template->build('acl/role-tree', $this->data);
	}
	
	function add()
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		$this->load->model('acl/resource_model');
		$this->data['resources'] = $this->resource_model->get_tree();
		$this->_updatedata();
	}
	
	function edit($role_id)
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		if (!is_numeric($role_id) || $role_id < 1)
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
		
		$this->load->model('acl/resource_model');
		$this->data['resources'] = $this->resource_model->get_tree();
		$this->data['role'] = $this->role_model->get_by_id($role_id);
		
		if ($this->data['role'])
			$this->_updatedata();
		else
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
	}
	
	function delete($role_id)
	{
		if (!is_numeric($role_id) || $role_id < 1)
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
		
		$this->data['role'] = $this->role_model->get_by_id($role_id);
		
		if ($this->data['role'])
		{
			$this->role_model->delete($role_id);
//			$this->template->set_flashdata('notify', lang('role_deleted'));
			redirect($this->data['redirect']);
		}
		else
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
	}
	
	function _updatedata()
	{
		// Setup form validation
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules(array(
			array('field'=>'name', 'label'=>'lang:role_name', 'rules'=>'trim|required|min_length[2]|max_length[255]|callback_role_name_check' . $this->input->post('id'))
		));
		
		// Run form validation
		if ($this->form_validation->run()) 
		{
			// Get attributes from posts.
			$attributes = array();
			$fields = array(
				'id',
				'name',
				'parents'
			);
			foreach ($fields as $field)
			{
				if ($this->input->post($field))
					$attributes[$field] = $this->input->post($field);
			}
			
			if (isset($attributes['id']))
			{
				$this->role_model->update($attributes['id'], $attributes);			// Update resource
				$this->template->set_flashdata('info', lang('role_updated'));
			}
			else
			{
				$this->role_model->update(0, $attributes);							// Add resource
				$this->template->set_flashdata('info', lang('role_added'));
			}

			if (isset($this->data['redirect']) && !empty($this->data['redirect']))
				redirect($this->data['redirect']);
			else
				redirect('acl/role');
		}
		
		// Load resource view
		$this->template->set_title(lang('role_page_name'));
		$this->template->build('acl/role-edit', $this->data);
	}
	
	function _send_message_redirect($type, $message)
	{
		$this->template->set_flashdata($type, $message);
		redirect('acl/role');
	}
}


/* End of file role.php */
/* Location: ./application/modules/acl/controllers/role.php */