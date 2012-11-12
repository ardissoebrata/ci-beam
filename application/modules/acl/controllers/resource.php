<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ACL Resource management controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Resource extends Admin_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation'));
		$this->load->model(array('acl/resource_model'));
		$this->load->language('acl/resource');
		$this->template->set_css('simple-lists');
		
		$this->data['resource_tree'] = $this->resource_model->get_tree();
		
		$this->data['isAjax'] = FALSE;
	}
	
	function index()
	{   
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		$this->template->set_title(lang('resource_page_name'))
				->build('acl/resource-tree', $this->data);
	}
	
	function add()
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
		$this->_updatedata();
	}
	
	function edit($resource_id)
	{
		$this->acl->build();
		$acl = $this->acl;
		$this->data['acl'] =  $acl;
                        
		if (!is_numeric($resource_id) || $resource_id < 1)
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));
		
		$this->data['resource'] = $this->resource_model->get_by_id($resource_id);
		
		if ($this->data['resource'])
			$this->_updatedata();
		else
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));
	}
	
	function delete($resource_id)
	{
		if (!is_numeric($resource_id) || $resource_id < 1)
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));
		
		$this->data['resource'] = $this->resource_model->get_by_id($resource_id);
		
		if ($this->data['resource'])
		{
			$this->resource_model->delete($resource_id);
			$this->template->set_flashdata('info', lang('resource_deleted'));
			redirect($this->data['redirect']);
		}
		else
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));
	}
	
	function _updatedata()
	{
		// Setup form validation
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules(array(
			array('field'=>'name', 'label'=>'lang:resource_name', 'rules'=>'trim|required|min_length[2]|max_length[255]|callback_resource_name_check' . $this->input->post('id'))
		));
		
		// Run form validation
		if ($this->form_validation->run()) 
		{
			// Get attributes from posts.
			$attributes = array();
			$fields = array(
				'id',
				'name',
				'type',
				'parent',
			);
			foreach ($fields as $field)
			{
				if ($this->input->post($field))
					$attributes[$field] = $this->input->post($field);
			}
			
			if (isset($attributes['id']))
			{
				$this->resource_model->update($attributes['id'], $attributes);			// Update resource
				$this->template->set_flashdata('info', lang('resource_updated'));
			}
			else
			{
				$this->resource_model->update(0, $attributes);							// Add resource
				$this->template->set_flashdata('info', lang('resource_added'));
			}

			redirect($this->data['redirect']);
		}
		
		// Load resource view
		$this->template->set_title(lang('resource_page_name'))
				->build('acl/resource-edit', $this->data);
	}
	
	/**
	 * Check if a resource name exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function resource_name_check($resource_name, $not_resource_id = 0)
	{
		if ($this->resource_model->get_by_name($resource_name, $not_resource_id)) 
		{
			$this->form_validation->set_message('resource_name_check', lang('resource_name_taken'));
			return FALSE;
		} 
		else
			return TRUE;
	}
	
	function _send_message_redirect($type, $message)
	{
		$this->template->set_flashdata($type, $message);
		redirect('acl/resource');
	}
}