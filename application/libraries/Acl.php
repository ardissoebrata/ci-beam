<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Zend\Permissions\Acl\Acl as Zend_Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl
{

	// Set the instance variable
	var $CI, $acl;

	function __construct()
	{
		// Get the instance
		$this->CI = & get_instance();
		$this->build();
	}

	function build()
	{
		$this->acl = new Zend_Acl();

		// Resources
		$this->CI->load->model('acl/resource_model');
		$rows = $this->CI->resource_model->get_all();
		while (count($rows) > 0) {
			$row = array_shift($rows);
			if (empty($row->parent_name))
				$this->acl->addResource(new Resource($row->name));
			elseif ((!empty($row->parent_name) && $this->acl->hasResource($row->parent_name)))
				$this->acl->addResource(new Resource($row->name), $row->parent_name);
			else
				array_push($rows, $row);
		}

		// Roles
		$this->CI->load->model('acl/role_model');
		$result = $this->CI->role_model->get_list();
		$rows = array();
		foreach ($result as $row) {
			$rows[$row->id]['name'] = $row->name;
			$rows[$row->id]['parents'] = array();
			if (!empty($row->parent_name))
				$rows[$row->id]['parents'][$row->parent_order] = $row->parent_name;
		}
		$this->acl->addRole(new Role('Administrator'));
		while (count($rows) > 0) {
			$row = array_shift($rows);
			// If role exists, continue;
			if ($this->acl->hasRole($row['name']))
				continue;

			// Check if every role parents exists.
			$isParentOk = TRUE;
			foreach ($row['parents'] as $parent_name) {
				if (!$this->acl->hasRole($parent_name)) {
					$isParentOk = FALSE;
					break;
				}
			}
			if (empty($row['parents']))
				$this->acl->addRole(new Role($row['name']));
			elseif ($isParentOk)
				$this->acl->addRole(new Role($row['name']), $row['parents']);
			else
				array_push($rows, $row);
		}

		// Rules
		$this->acl->allow('Administrator');
		$this->CI->load->model('acl/rule_model');
		$rows = $this->CI->rule_model->get_all();
		foreach ($rows as $row) {
			if ($row->access == 'allow')
				$this->acl->allow($row->role_name, $row->resource_name);
			else
				$this->acl->deny($row->role_name, $row->resource_name);
		}
	}

	// Function to check if the current or a preset role has access to a resource
	function is_allowed($resource, $role = '')
	{
		// Home page always available to all.
		if ($resource === '')
			return TRUE;
		
		// Check uri_string resources from the longest segment
		$has_resource = $this->has($resource);
		while ((strlen($resource) > 0) && !$has_resource) {
			$pos = strrpos($resource, '/');
			if ($pos === FALSE)
				$resource = '';
			else {
				$resource = substr($resource, 0, $pos);
				$has_resource = $this->has($resource);
			}
		}

		// If resource not exists, default to 'deny'.
		if (!$has_resource) {
			return FALSE;
		}

		// If role empty, try search the session.
		if (empty($role)) {
			if (isset($this->CI->session->role_name)) {
				$role = $this->CI->session->role_name;
			}
		}

		// If role empty or not exists, default to 'deny'.
		if (empty($role) || !$this->has_role($role)) {
			return false;
		}
		return $this->acl->isAllowed($role, $resource);
	}

	function has($resource)
	{
		return $this->acl->hasResource($resource);
	}

	function has_role($role)
	{
		return $this->acl->hasRole($role);
	}

}
