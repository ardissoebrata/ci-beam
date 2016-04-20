<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends MY_Model
{

	protected $table = 'acl_roles';
	protected $role_parents_table = 'acl_role_parents';
	protected $rules_table = 'acl_rules';
	protected $has_updated_field = true;
	public $validation_rules = array(
		'id' => array(
			'helper' => 'form_hidden'
		),
		'name' => array(
			'label' => 'lang:role_name',
			'rules' => 'trim|required|min_length[2]|max_length[255]|callback_role_name_check',
			'helper' => 'form_inputlabel',
		),
	);

	function get_list($base_url = '', $offset = 0, $limit = 0)
	{
		$this->db->select($this->table . '.*, ' .
				'role_parent.name AS parent_name, ' .
				$this->role_parents_table . '.order AS parent_order')
				->join($this->role_parents_table, $this->role_parents_table . '.role_id = ' . $this->table . '.id', 'left')
				->join($this->table . ' role_parent', 'role_parent.id = ' . $this->role_parents_table . '.parent', 'left')
				->order_by($this->table . '.id', 'ASC')
				->order_by($this->role_parents_table . '.order', 'ASC');
		return $this->db->get($this->table)->result();
	}
	
	/**
	 * Get roles as tree of array
	 * 
	 * @param int $parent	Parent id of the roles to display (default: 0).
	 * @return array		Array of roles as tree. 
	 */
	function get_tree($parent = 0, $not_id = 0)
	{
		$results = array();

		if ($not_id > 0)
			$this->db->where($this->table . '.id != ' . $not_id);

		$this->db->join($this->role_parents_table, $this->role_parents_table . '.role_id = ' . $this->table . '.id', 'left')
				->order_by($this->table . '.name');

		if ($parent > 0)
			$this->db->where($this->role_parents_table . '.parent', $parent);
		else
			$this->db->where($this->role_parents_table . '.parent IS NULL');

		$query = $this->db->get($this->table);
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
	 * Get role by id
	 * 
	 * @param int $id
	 * @return object resource
	 */
	function get_by_id($id)
	{
		$row = parent::get_by_id($id);

		if ($row)
			$row->parents = $this->get_parents($row->id);

		return $row;
	}

	/**
	 * Get role by name
	 * 
	 * @param string $name
	 * @param int $not_id
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
	 * Get parents by role id
	 * 
	 * @param int $role_id
	 * @return array Array of role parents objects. 
	 */
	function get_parents($role_id)
	{
		$this->db->select($this->role_parents_table . '.*, ' .
						$this->table . '.name AS parent_name')
				->join($this->table, $this->table . '.id = ' . $this->role_parents_table . '.parent', 'left')
				->order_by('order');
		return $this->db->get_where($this->role_parents_table, array($this->role_parents_table . '.role_id' => $role_id))->result();
	}

	/**
	 * Update role details
	 *
	 * @access public
	 * @param int $role_id
	 * @param array $attributes
	 * @return void
	 */
	function update($role_id = 0, $attributes = array())
	{
		$parents = array();
		if (isset($attributes['parents'])) {
			$parents = $attributes['parents'];
			unset($attributes['parents']);
		}
		
		if (($role_id > 0) && (!$this->get_by_name($attributes['name'], $role_id))) {   // Update
			parent::update($role_id, $attributes);
		} elseif (!$this->get_by_name($attributes['name'])) {		  // Insert
			$role_id = parent::insert($attributes);
		} else
			return FALSE;

		$this->db->delete($this->role_parents_table, array('role_id' => $attributes['id']));
		if (!empty($parents)) {
			foreach ($parents as $index => $parent) {
				if ($this->get_by_id($parent))
					$this->db->insert($this->role_parents_table, array('role_id' => $attributes['id'], 'parent' => $parent, 'order' => $index));
			}
		}
		return $role_id;
	}

	/**
	 * Delete role
	 * 
	 * @param int $role_id 
	 */
	function delete($role_id)
	{
		//TODO: Throw exception if this role has users in it.
		//Check children
		$children = $this->db->get_where($this->role_parents_table, array('parent' => $role_id))->result();
		if ($children) {
			foreach ($children as $row) {
				$this->delete($row->role_id);
			}
		}

		$this->db->delete($this->rules_table, array('role_id' => $role_id));
		$this->db->delete($this->role_parents_table, array('role_id' => $role_id));
		$this->db->delete($this->table, array('id' => $role_id));
	}

}
