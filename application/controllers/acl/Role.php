<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ACL Role management controller
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Role extends Admin_Controller
{

	protected $controller = 'acl/role';

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation'));
		$this->load->model('acl/role_model');
		$this->load->language('acl');

		$this->acl->build();
		$this->load->vars(array(
			'acl' => $this->acl,
			'role_tree' => $this->role_model->get_tree()
		));
	}

	function index()
	{
		$this->template->set_title(lang('role_page_name'))
				->build('acl/role-tree');
	}

	function add()
	{
		$this->_updatedata();
	}

	function edit($role_id)
	{
		$this->_updatedata($role_id);
	}

	function _updatedata($id = 0)
	{
		$post_id = $this->input->post("id");
		if (is_numeric($post_id) && $post_id > 0)
			$id = $post_id;

		// Setup form validation
		$this->load->library('form_validation');
		$validation_rules = $this->role_model->validation_rules;

		if ($id > 0) {
			$role = $this->role_model->get_by_id($id);
			$this->form_validation->set_default($role);

			$validation_rules['name']['rules'] .= '[' . $id . ']';
		}

		$this->form_validation->init($validation_rules);

		// Run form validation
		if ($this->form_validation->run()) {
			$values = $this->form_validation->get_values();

			if ($id > 0) {
				$this->role_model->update($id, $values);   // Update role
				$this->template->set_flashdata('success', lang('role_updated'));
			} else {
				if (isset($values['parent']) && $values['parent'] == 0)
					$values['parent'] = NULL;
				$this->role_model->insert($values);	// Add role
				$this->template->set_flashdata('success', lang('role_added'));
			}
			redirect($this->controller);
		}

		// Load resource view
		$this->template->set_title(lang('role_page_name'))
				->build('acl/role-tree', array('form' => $this->form_validation));
	}

	function delete($role_id)
	{
		if (!is_numeric($role_id) || $role_id < 1)
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));

		$this->data['role'] = $this->role_model->get_by_id($role_id);

		if ($this->data['role']) {
			$this->role_model->delete($role_id);
			$this->template->set_flashdata('notify', lang('role_deleted'));
			redirect('acl/role');
		} else
			$this->_send_message_redirect('error', lang('role_cannot_be_found'));
	}

	/**
	 * Check if a role name exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function role_name_check($role_name, $not_role_id = 0)
	{
		if ($this->role_model->get_by_name($role_name, $not_role_id)) {
			$this->form_validation->set_message('role_name_check', lang('role_name_taken'));
			return FALSE;
		} else
			return TRUE;
	}

	function _send_message_redirect($type, $message)
	{
		$this->template->set_flashdata($type, $message);
		redirect('acl/role');
	}

}
