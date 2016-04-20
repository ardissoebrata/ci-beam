<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ACL Resource management controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Resource extends Admin_Controller
{

	protected $controller = 'acl/resource';
	
	function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation'));
		$this->load->model(array('acl/resource_model'));
		$this->load->language('acl');

		$this->acl->build();
		$this->load->vars(array(
			'acl' => $this->acl,
			'resource_tree' => $this->resource_model->get_tree(),
		));
	}

	function index()
	{
		$this->template->set_title(lang('resource_page_name'))
			->build('acl/resource-tree');
	}

	function add()
	{
		$this->_updatedata();
	}

	function edit($resource_id)
	{
		$this->_updatedata($resource_id);
	}

	function _updatedata($id = 0)
	{
		$post_id = $this->input->post("id");
		if (is_numeric($post_id) && $post_id > 0)
			$id = $post_id;
		
		// Setup form validation
		$this->load->library('form_validation');
		$validation_rules = $this->resource_model->validation_rules;
		
		if ($id > 0) {
			$resource = $this->resource_model->get_by_id($id);
			$this->form_validation->set_default($resource);
			
			$validation_rules['name']['rules'] .= '[' . $id . ']';
		}
		
		$this->form_validation->init($validation_rules);
		
		// Run form validation
		if ($this->form_validation->run()) {
			$values = $this->form_validation->get_values();

			if ($id > 0) {
				$this->resource_model->update($id, $values);   // Update resource
				$this->template->set_flashdata('success', lang('resource_updated'));
			} else {
				if (isset($values['parent']) && $values['parent'] == 0)
					$values['parent'] = NULL;
				$this->resource_model->insert($values);	   // Add resource
				$this->template->set_flashdata('success', lang('resource_added'));
			}
			redirect($this->controller);
		}
		
		// Load resource view
		$this->template->set_title(lang('resource_page_name'))
				->build('acl/resource-tree', array('form' => $this->form_validation));
	}

	function delete($resource_id)
	{
		if (!is_numeric($resource_id) || $resource_id < 1)
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));

		$resource = $this->resource_model->get_by_id($resource_id);

		if ($resource) {
			$this->resource_model->delete($resource_id);
			$this->template->set_flashdata('info', lang('resource_deleted'));
			redirect($this->controller);
		} else
			$this->_send_message_redirect('error', lang('resource_cannot_be_found'));
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
		if ($this->resource_model->get_by_name($resource_name, $not_resource_id)) {
			$this->form_validation->set_message('resource_name_check', lang('resource_name_taken'));
			return FALSE;
		} else
			return TRUE;
	}

	function _send_message_redirect($type, $message)
	{
		$this->template->set_flashdata($type, $message);
		redirect($this->controller);
	}

}
