<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rule_model extends MY_Model 
{
	protected $table_name = 'acl_rules';
	protected $resource_table = 'acl_resources';
	protected $role_table = 'acl_roles';
	
	function get_list()
	{
		$this->db->select($this->table_name . '.*, ' .
				$this->role_table . '.name AS role_name, ' .
				$this->resource_table . '.name AS resource_name')
			->join($this->role_table, $this->role_table . '.id = ' . $this->table_name . '.role_id', 'left')
			->join($this->resource_table, $this->resource_table . '.id = ' . $this->table_name . '.resource_id', 'left');
		return $this->db->get($this->table_name)->result();
	}
	
	/**
	 * Get rule by id
	 * 
	 * @param int $roleid
	 * @param int $resourceid
	 * @return object resource
	 */
	function get_by_id($roleid, $resourceid = 0)
	{
		if ($resourceid > 0)
			$this->db->where('resource_id', $resourceid);
		return $this->db->get_where('acl_rules', array('role_id' => $roleid))->result();
	}
	
	function update($roleid, $attributes)
	{
		$this->db->delete($this->table_name, array('role_id' => $roleid));
		if (isset($attributes['rule_resource']))
		{
			foreach($attributes['rule_resource'] as $index => $rule)
			{
				if (!empty($rule))
				{
					$this->db->insert($this->table_name, array(
						'role_id'		=> $roleid,
						'resource_id'	=> $index,
						'access'		=> $rule
					));
				}
			}
		}
	}
	
}

/* End of file acl_rule_model.php */
/* Location: ./application/modules/acl/models/acl_rule_model.php */