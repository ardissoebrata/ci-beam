<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resource_model extends MY_Model
{

	protected $table = 'acl_resources';
	protected $rules_table = 'acl_rules';
	protected $has_updated_field = true;
	public $validation_rules = array(
		'id' => array(
			'helper' => 'form_hidden'
		),
		'name' => array(
			'label' => 'lang:resource_name',
			'rules' => 'trim|required|min_length[2]|max_length[255]|callback_resource_name_check',
			'helper' => 'form_inputlabel',
		),
		'type' => array(
			'label' => 'lang:resource_type',
			'rules' => 'trim|required',
			'helper' => 'form_dropdownlabel',
			'options' => array(
				'module'		=> 'Module',
				'controller'	=> 'Controller',
				'action'		=> 'Action',
				'other'			=> 'Other',
			)
		),
		'parent' => array(
			'label' => 'lang:resource_parent',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel',
		),
	);

	/**
	 * Get resources as tree of array
	 * 
	 * @param int $parent	Parent id of the resources to display (default: 0).
	 * @return array		Array of resources as tree. 
	 */
	function get_tree($parent = NULL, $not_id = 0)
	{
		$results = array();

		if ($not_id > 0)
			$this->db->where($this->table . '.id != ' . $not_id);

		$this->db->order_by('name');
		$query = $this->db->get_where($this->table, array('parent' => $parent));

		if ($query->num_rows() > 0) {
			$results = $query->result_array();
			foreach ($results as $index => $row) {
				$children = $this->get_tree($row['id']);
				if (!empty($children))
					$results[$index]['children'] = $children;
			}
		}
		return $results;
	}

	/**
	 * Get resource by name
	 * 
	 * @param string $name
	 * @return object resource
	 */
	function get_by_name($name, $not_id = 0)
	{
		$this->db->where('name', $name);
		if ($not_id > 0)
			$this->db->where('id !=', $not_id);
		return $this->db->get($this->table)->row();
	}

	/**
	 * Get child resources
	 * 
	 * @param ing $parentid
	 * @return object resources
	 */
	function get_by_parent($parentid, $not_id = 0)
	{
		if ($not_id > 0)
			$this->db->where($this->table . '.id != ' . $not_id);

		return $this->db->order_by('name')->get_where($this->table, array('parent' => $parentid))->result();
	}

	/**
	 * Update resource details
	 *
	 * @access public
	 * @param int $resource_id
	 * @param array $attributes
	 * @return void
	 */
	function update($resource_id = 0, $attributes = array())
	{
		if (($resource_id > 0) && (!$this->get_by_name($attributes['name'], $resource_id))) { // Update
			return parent::update($resource_id, $attributes);
		} elseif (!$this->get_by_name($attributes['name'])) {		  // Insert
			return parent::insert($attributes);
		} else
			return FALSE;
	}

	/**
	 * Delete resource
	 * 
	 * @param int $resource_id 
	 */
	function delete($resource_id)
	{
		//Check children
		$children = $this->get_by_parent($resource_id);
		if ($children) {
			foreach ($children as $row) {
				$this->delete($row->id);
			}
		}
		$this->db->delete($this->rules_table, array('resource_id' => $resource_id));
		$this->db->delete($this->table, array('id' => $resource_id));
	}

}
