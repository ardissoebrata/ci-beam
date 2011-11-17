<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Checkbox Field with label.
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_checkboxlabel'))
{
	function form_checkboxlabel($data = '', $value = '', $label = '', $checked = FALSE, $extra = '')
	{
		$defaults = array('type' => 'checkbox', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		if (is_array($data) AND array_key_exists('checked', $data))
		{
			$checked = $data['checked'];

			if ($checked == FALSE)
			{
				unset($data['checked']);
			}
			else
			{
				$data['checked'] = 'checked';
			}
		}

		if ($checked == TRUE)
		{
			$defaults['checked'] = 'checked';
		}
		else
		{
			unset($defaults['checked']);
		}
		
		if (is_array($data) AND array_key_exists('label', $data))
		{
			if (empty($label))
			{
				$label = $data['label'];
			}
			unset($data['label']);
		}
		if (! empty($label))
		{
			$label = '<span>' . $label . '</span>';
		}
		
		return "<label><input "._parse_form_attributes($data, $defaults).$extra." />" . $label . "</label>";
	}
}