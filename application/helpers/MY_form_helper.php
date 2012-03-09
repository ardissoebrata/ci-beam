<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI-Beam Form Helpers
 *
 * @package		CI-Beam
 * @category	Helpers
 * @author		Ardi Soebrata
 */

// ------------------------------------------------------------------------

if ( ! function_exists('_generate_input_label'))
{
	/**
	 * Generate Input Field with Label
	 * 
	 * @param string $name
	 * @param string $label
	 * @param boolean $required
	 * @param string $value
	 * @param array $data
	 * @return string 
	 */
	function _generate_input_label($type, $name, $label, $required = FALSE, $value = '', $data = array())
	{
		$defaults = array('type' => $type, 'name' => $name, 'id' => $name, 'value' => set_value($name, $value));
		if ($required) $defaults['required'] = 'required';
		
		$output = '<div class="control-group' . ((form_error($name)) ? ' error' : '') . '">';
		$output .= form_label($label, $name, array('class' => 'control-label'));
		$output .= '<div class="controls">';
		
		if ($required)
			$output .= '<div class="input-append">';
		
		$output .= "<input " . _parse_form_attributes($data, $defaults) . " />";
		
		if ($required)
			$output .= '<span class="add-on"><i class="icon-asterisk"></i></span></div>';
		
		$output .= form_error($name, '<span class="help-inline">', '</span>');
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		
		return $output;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_inputlabel'))
{
	/**
	 * Text Input Field with Label
	 * 
	 * @param string $name
	 * @param string $label
	 * @param boolean $required
	 * @param string $value
	 * @param array $data
	 * @return string 
	 * @uses _generate_input_label()
	 */
	function form_inputlabel($name, $label, $required = FALSE, $value = '', $data = '')
	{
		return _generate_input_label('text', $name, $label, $required, $value, $data);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_emaillabel'))
{
	/**
	 * Email Input Field with Label
	 * 
	 * @param string $name
	 * @param string $label
	 * @param boolean $required
	 * @param string $value
	 * @param array $data
	 * @return string
	 * @uses _generate_input_label() 
	 */
	function form_emaillabel($name, $label, $required = FALSE, $value = '', $data = '')
	{
		return _generate_input_label('email', $name, $label, $required, $value, $data);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_passwordlabel'))
{
	/**
	 * Password Input Field with Label
	 * 
	 * @param string $name
	 * @param string $label
	 * @param boolean $required
	 * @param string $value
	 * @param array $data
	 * @return string
	 * @uses _generate_input_label() 
	 */
	function form_passwordlabel($name, $label, $required = FALSE, $value = '', $data = '')
	{
		return _generate_input_label('password', $name, $label, $required, $value, $data);
	}
}

if ( ! function_exists('form_actions'))
{
	/**
	 * Form Buttons 
	 * 
	 * @param array $buttons
	 * @return string 
	 */
	function form_actions($buttons = array())
	{
		if (count($buttons) == 0) return '';
		
		$output = '<div class="form-actions">';
		foreach($buttons as $name => $attributes)
		{
			$attributes['class'] = (isset($attributes['class'])) ? $attributes['class'] . ' btn' : 'btn';
			if (!isset($attributes['name']))
				$attributes['name'] = $attributes['id'];
			$output .= form_submit($attributes) . "\r\n";
		}
		$output .= '</div>';
		return $output;
	}
}