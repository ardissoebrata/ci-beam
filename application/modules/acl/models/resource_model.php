<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource_model extends MY_Model 
{
	protected $table_name = 'acl_resources';
	protected $rules_table = 'acl_rules';
	
	/**
	 * Get resource list
	 * 
	 * @param int		Maximum number of rows to return.
	 * @param int		Number of rows to skip.
	 * @param string	Field name to be sorted by.
	 * @param string	Order of the sort ('asc'|'desc').
	 * @param string	Search string to be applied to the list.
	 * @return array	Array of resource objects
	 */
	function get_list($limit = 0, $offset = 0, $sort_by = 'name', $sort_order = 'asc', $search = '')
	{
		$limit = empty($limit) ? $this->config->item('item_per_page') : $limit;
		$sort_by = empty($sort_by) ? 'name' : $sort_by;
		$sort_order = empty($sort_order) ? 'asc' : $sort_order;
		
		if (!empty($search))
			$this->db->like($this->table_name . '.name', $search);
		
		$this->db->select($this->table_name . '.*, parent_resource.name AS parent_name')
			->join($this->table_name . ' parent_resource', 'parent_resource.id = ' . $this->table_name . '.parent', 'left');
		
		$this->db->order_by($sort_by, $sort_order);
		
		return $this->db->get($this->table_name, $limit, $offset)->result();
	}
	
	/**
	 * Get resource list count
	 * 
	 * @param string	Search filter to be applied to the count.
	 * @return int		Number of rows in list.
	 */
	function get_list_count($search = '')
	{
		if (!empty($search))
			$this->db->like($this->table_name . '.name', $search);
		
		return $this->db->count_all_results($this->table_name);
	}
	
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
			$this->db->where($this->table_name . '.id != ' . $not_id);
		
		$this->db->order_by('name');
		$query = $this->db->get_where($this->table_name, array('parent' => $parent));
		
		if ($query->num_rows() > 0)
		{
			$results = $query->result_array();
			foreach($results as $index => $row)
			{
				$children = $this->get_tree($row['id']);
				if (!empty($children))
					$results[$index]['children'] = $children;
			}
				
		}
		return $results;
	}
	
	/**
	 * Get resource by id
	 * 
	 * @param int $id
	 * @return object resource
	 */
	function get_by_id($id)
	{
		return $this->db->get_where($this->table_name, array('id' => $id))->row();
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
		return $this->db->get($this->table_name)->row();
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
			$this->db->where($this->table_name . '.id != ' . $not_id);
		
		return $this->db->order_by('name')->get_where($this->table_name, array('parent' => $parentid))->result();
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
		if (($resource_id > 0) && (! $this->get_by_name($attributes['name'], $resource_id)))	// Update
		{
			$attributes['modified'] = date('Y-m-d H:i:s');
			$this->db->where('id', $resource_id);
			$this->db->update($this->table_name, $attributes);
			return TRUE;
		}
		elseif (! $this->get_by_name($attributes['name']))										// Insert
		{
			unset($attributes['id']);
			$attributes['created'] = date('Y-m-d H:i:s');
			$this->db->insert($this->table_name, $attributes);
			return TRUE;
		}
		else
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
		if ($children)
		{
			foreach($children as $row)
			{
				$this->delete($row->id);
			}
		}
		$this->db->delete($this->rules_table, array('resource_id' => $resource_id));
		$this->db->delete($this->table_name, array('id' => $resource_id));
	}
}

/* End of file resource_model.php */
/* Location: ./application/modules/acl/models/resource_model.php */