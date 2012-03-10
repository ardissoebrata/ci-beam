<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extended Forms with Validation
 * 
 * @package CI-Beam
 * @category Library
 * @author Ardi Soebrata 
 */

/**
 * Extends Forms with Validation
 */
class MY_Form_validation extends CI_Form_validation
{
	/**
	 * List of fields
	 * 
	 * @var array
	 */
	protected $fields = array();
	
	/**
	 * Default data as Doctrine2 entity object.
	 * 
	 * @var object
	 */
	protected $obj_data;
	
	/**
	 * Initialize form fields
	 * 
	 * Field list:
	 *		array(
	 *			'<field_name>' => array(
	 *				'helper' => '<field_helper>',
	 *				'label'	=> '<field_label>',		// optional: for hidden fields.
	 *				'rules' => '<field_rules>',		// optional: for hidden fields.
	 *				'value' => '<field_value>',		// optional: force field value.
	 *				'extra' => array(<field_extra>) // optional: field extras.
	 *			),
	 *			...
	 *		);
	 * 
	 * @param array $fields
	 * @return \MY_Form_validation 
	 */
	public function init($fields)
	{
		$this->fields = $fields;
		foreach($this->fields as $name => $field)
		{
			if (isset($field['label']) && isset($field['rules']))
				$this->set_rules($name, $field['label'], $field['rules']);
		}
		
		return $this;
	}
	
	/**
	 * Set default values from Doctrine2 object.
	 * 
	 * @param object $obj
	 * @return \MY_Form_validation 
	 */
	public function set_default($obj)
	{
		$this->obj_data = $obj;
		return $this;
	}
	
	/**
	 * Get default Doctrine2 object.
	 * 
	 * @return object
	 */
	public function get_default()
	{
		return $this->obj_data;
	}
	
	/**
	 * Display form field.
	 * 
	 * @param string $field_name
	 * @param string $value
	 * @return string 
	 */
	public function field($field_name, $value = '')
	{
		// Set field value
		$func_name = str_replace('_', ' ', $field_name);
		$func_name = ucwords($func_name);
		$func_name = 'get' . str_replace(' ', '', $func_name);
		
		if (isset($this->fields[$field_name]['value']))
			$value = $this->fields[$field_name]['value'];
		elseif (!empty($this->obj_data) && is_callable(array($this->obj_data, $func_name)))
			$value = call_user_func(array($this->obj_data, $func_name));
		
		// Is field required?
		$is_required = (isset($this->fields[$field_name]['rules']))? (strpos($this->fields[$field_name]['rules'], 'required') !== FALSE) : FALSE;
		// Get extra field attributes.
		$extra = (isset($this->fields[$field_name]['extra']))? $this->fields[$field_name]['extra'] : array();
		
		// Execute form helpers
		switch ($this->fields[$field_name]['helper'])
		{
			case 'form_input':
			case 'form_password':
			case 'form_textarea':
				$extra['id'] = $field_name;
				$extra['name'] = $field_name;
				$extra['value'] = $value;
				return call_user_func($this->fields[$field_name]['helper'], $extra);
			case 'form_hidden':
				return call_user_func($this->fields[$field_name]['helper'], $field_name, $value);
			case 'form_inputlabel': 
			case 'form_emaillabel':
			case 'form_passwordlabel':
				return call_user_func($this->fields[$field_name]['helper'], $field_name, $this->fields[$field_name]['label'], $is_required, $value, $extra);
			default:
				show_error('Cannot find helper "' . $this->fields[$field_name]['helper'] . '".');
				return '';
		}
	}
	
	/**
	 * Display form fields. 
	 * 
	 * @param array $field_names Array of field names to display. Display all fields if empty.
	 * @return string
	 */
	public function fields($field_names = array())
	{
		if (empty($field_names))
			$field_names = array_keys($this->fields);
		
		$output = '';
		foreach($field_names as $field_name)
			$output .= $this->field($field_name) . "\r\n";
		return $output;
	}
	
	/**
	 * Get updated values in Doctrine2 object from form values.
	 * 
	 * @param object $obj_data Doctrine2 object to update. Use object from default if empty.
	 * @return object 
	 */
	public function set_values($obj_data = NULL)
	{
		if (!empty($obj_data)) $this->obj_data = $obj_data;
		if (empty($this->obj_data)) return NULL;
		
		foreach($this->fields as $field_name => $field)
		{
			// Set field value
			$func_name = str_replace('_', ' ', $field_name);
			$func_name = ucwords($func_name);
			$func_name = 'set' . str_replace(' ', '', $func_name);

			if (is_callable(array($this->obj_data, $func_name)))
				call_user_func(array($this->obj_data, $func_name), set_value($field_name));
		}
		
		return $this->obj_data;
	}
}
