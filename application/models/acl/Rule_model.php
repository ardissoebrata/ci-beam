<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rule_model extends MY_Model
{

	protected $table = 'acl_rules';
	protected $resource_table = 'acl_resources';
	protected $role_table = 'acl_roles';

	public function prep_query()
	{
		parent::prep_query();
		
		$this->db->select($this->table . '.*, ' .
						$this->role_table . '.name AS role_name, ' .
						$this->resource_table . '.name AS resource_name')
				->join($this->role_table, $this->role_table . '.id = ' . $this->table . '.role_id', 'left')
				->join($this->resource_table, $this->resource_table . '.id = ' . $this->table . '.resource_id', 'left');
	}

	/**
	 * Get rule by id
	 * 
	 * @param int $roleid
	 * @param int $resourceid
	 * @return object resource
	 */
	public function get_by_id($roleid, $resourceid = 0)
	{
		if ($resourceid > 0)
			$this->db->where('resource_id', $resourceid);
		return $this->db->get_where('acl_rules', array('role_id' => $roleid))->result();
	}

	public function update($roleid, $attributes)
	{
		$this->db->delete($this->table, array('role_id' => $roleid));
		if (isset($attributes['rule_resource'])) {
			foreach ($attributes['rule_resource'] as $index => $rule) {
				if (!empty($rule)) {
					$this->db->insert($this->table, array(
						'role_id' => $roleid,
						'resource_id' => $index,
						'access' => $rule
					));
				}
			}
		}
	}

}
