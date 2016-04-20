<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI-Beam Form Helpers
 *
 * @package		CI-Beam
 * @category	Helpers
 * @author		Ardi Soebrata
 */

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Parse the form attributes
 *
 * Helper function used by some of the form helpers
 *
 * @access	private
 * @param	array
 * @param	array
 * @return	string
 */
if ( ! function_exists('_parse_form_attributes_ex'))
{
	function _parse_form_attributes_ex($attributes, $default)
	{
		if (is_array($attributes))
		{
			foreach ($default as $key => $val)
			{
				if (isset($attributes[$key]))
				{
					$default[$key] = $attributes[$key];
					unset($attributes[$key]);
				}
			}

			if (count($attributes) > 0)
			{
				$default = array_merge($default, $attributes);
			}
		}

		$att = '';

		foreach ($default as $key => $val)
		{
			if ($key == 'value')
			{
				$val = form_prep($val, $default['name']);
			}

			if (strpos($val, '"') >= 0)
				$att .= $key . '=\'' . $val . '\' ';
			else
				$att .= $key . '="' . $val . '" ';
		}

		return $att;
	}
}

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
	function _generate_input_label($type, $name, $label, $required = FALSE, $value = '', $data = array(), $append = FALSE)
	{
		if ($value instanceof DateTime)
		{
			if ($value->format('H:i:s') == '00:00:00')
				$value = $value->format('Y-m-d');
			else
				$value = $value->format('Y-m-d H:i:s');
		}
		$defaults = array('type' => $type, 'name' => $name, 'id' => $name, 'value' => set_value($name, $value), 'class' => 'form-control');
		
		$output = '<div class="form-group' . ((form_error($name)) ? ' has-error' : '') . '">';
		$output .= form_label($label . ($required ? ' <span class="required">*</span>' : ''), $name, array('class' => 'col-sm-4 control-label'));
		$output .= '<div class="col-sm-8 ';
		
		
		if ($append):
			$output .= 'input-group';
		endif;
		$output .='">';
		$output .= "<input " . _parse_form_attributes_ex($data, $defaults) . " />";
		
		
		if ($append):
			$output .= '<span class="input-group-addon">'.$append.'</span>';			
		endif;
		
		$output .= form_error($name, '<label for="' . $name . '" class="error">', '</span>');
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
	function form_inputlabel($name, $label, $required = FALSE, $value = '', $data = '', $append = FALSE)
	{
		return _generate_input_label('text', $name, $label, $required, $value, $data, $append);
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
		
		$output = '<div class="form-group">'. "\r\n";
		$output .= '<div class="col-sm-offset-4 col-sm-8">';
		foreach($buttons as $name => $attributes)
		{
			$attributes['class'] = (isset($attributes['class'])) ? $attributes['class'] . ' btn' : 'btn btn-default';
			if (!isset($attributes['name']))
				$attributes['name'] = $attributes['id'];
			$output .= form_submit($attributes) . "\r\n";
		}
		$output .= '</div></div>';
		return $output;
	}
}

if ( ! function_exists('form_dropdownlabel'))
{
	function form_dropdownlabel($name, $label, $required = FALSE, $options = array(), $selected = array(), $extra = '')
	{
		$output = '<div class="form-group' . ((form_error($name)) ? ' has-error' : '') . '">';
		$output .= form_label($label . ($required ? ' <span class="required">*</span>' : ''), $name, array('class' => 'col-sm-4 control-label'));
		$output .= '<div class="col-sm-8">';
		
		if (empty($extra)){
			$extras = 'class="form-control"';
		}else{
			
			if(isset($extra['class'])){
				$extras = 'class="form-control '.$extra['class'].'" ';
				unset($extra['class']);
			}else{
				$extras = 'class="form-control" ';
			}
			
			foreach ($extra as $key => $value) {
				if(!empty($key))
					$extras.= $key.'="'.$value.'" ';
			}
		}
		$extras .= 'id="' . $name . '" ';
		
		$output .= form_dropdown($name, $options, set_value($name, $selected), $extras);
		$output .= form_error($name, '<label for="' . $name . '" class="error">', '</span>');
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		
		return $output;
	}
}

if ( ! function_exists('form_checkboxlabel'))
{
	function form_checkboxlabel($name, $label, $required = FALSE, $options = array(), $selected = array(), $extra = '')
	{
		$output = '<div class="form-group' . ((form_error($name)) ? ' has-error' : '') . '">';
		$output .= form_label($label . ($required ? ' <span class="required">*</span>' : ''), $name, array('class' => 'col-sm-4 control-label'));
		$output .= '<div class="col-sm-8">';
		
		$extras = '';
		if (is_array($extra))
		{
			foreach ($extra as $key => $value) {
				if(!empty($key))
					$extras.= $key.'="'.$value.'" ';
			}
		}
		
		foreach($options as $key => $value)
		{
			$output .= '<div class="checkbox-custom checkbox-default">';
			$output .= '<input type="checkbox" id="' . $name . '_' . $key . '" name="' . $name . '[]" value="' . $key . '" ' . $extras . set_checkbox($name, $key, in_array($key, $selected)) . ' />';
			$output .= '<label for="' . $name . '_' . $key . '">' . $value . '&nbsp;</label>';
			$output .= '</div>';
		}
		
		$output .= form_error($name . '[]', '<label for="' . $name . '" class="error">', '</span>');
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		
		return $output;
	}
}

if ( ! function_exists('form_uneditablelabel'))
{
	function form_uneditablelabel($name, $label, $value, $options = array())
	{
		
		$defaults = array('name' => $name, 'id' => $name);
		// if ($value instanceof Date)
		
		if (preg_match("/\d{4}-\d{2}-\d{2}/", $value, $matches))
		{
						
			$date_array = explode('-', $value);
			$date = FALSE;
			if (count($date_array) == 3)				
				$date = strtotime($date_array[2] . '-' . $date_array[1] . '-' . $date_array[0]);
			if ($date === FALSE)
				$date = strtotime($value);
			if ($date)
				$value = date('d-m-Y', $date);
			if($value!='0000-00-00'){
				$value = $value;
			}else{
				$value = "";
			}
			
		}
			
		if (!empty($options) && isset($options[$value]))
			$value = $options[$value];
		
		if (!isset($options['class']))
			$options['class'] = '';
		$options['class'] .= ' uneditable-input';
		
		$output = '<div class="form-group">';
		$output .= form_label($label, '', array('class' => 'col-sm-4 control-label'));
		$output .= '<div class="controls">';
		$output .= '<p class="form-control-static ' . $class . '" ' . _parse_form_attributes_ex($options, array()) . '>' . $value . '</p>';
		// $output .= '<span ' . _parse_form_attributes($options, $defaults) . '">' . $value . '</span>';
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		return $output;
	}
}
if ( ! function_exists('form_uneditable'))
{
	function form_uneditable($label, $value, $class = "", $options = array())
	{
		if ($value instanceof DateTime)
		{
			if ($value->format('H:i:s') == '00:00:00')
				$value = $value->format('d F Y');
			else
				$value = $value->format('d F Y H:i:s');
		}
			
		if (!empty($options) && isset($options['value']))
		{
			$value = $options['value'];
			unset($options['value']);
		}
		
		$output = '<div class="form-group">';
		$output .= form_label($label, '', array('class' => 'col-sm-4 control-label'));
		$output .= '<div class="col-sm-8">';
		$output .= '<p class="form-control-static ' . $class . '" ' . _parse_form_attributes_ex($options, array()) . '>' . $value . '</p>';
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		return $output;
	}
}

if ( ! function_exists('form_datelonglabel'))
{
	function form_datelonglabel($name, $label, $required = FALSE, $value = '', $data = '')
	{
		$defaults = array('name' => $name, 'id' => $name, 'value' => set_value($name, $value));
		
		$output = '<div class="control-group' . ((form_error($name)) ? ' error' : '') . '">';
		$output .= form_label($label, $name, array('class' => 'control-label'));
		$output .= '<div class="controls">';
		
		$output .= "<input " . _parse_form_attributes($data, $defaults) . " />";
		
		if ($required)
			$output .= '<div class="input-append">';
		
		if ($required)
			$output .= '<span class="add-on"><i class="icon-asterisk"></i></span></div>';
		
		$output .= form_error($name, '<span class="help-inline">', '</span>');
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		
		return $output;
	}
}

/**
 * Modal confirmation window link button.
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_confirmwindow'))
{
	function form_confirmwindow($name, $link_title, $window_title, $window_content, $target_url, $class = 'btn-danger', $modal_class = '')
	{
		$cancel = lang('cancel');
		if (empty($cancel)) $cancel = 'Cancel';
		$ok = lang('ok');
		if (empty($ok)) $ok = 'OK';
		
		if (empty($modal_class))
			$modal_class = $class;
		
		$out = '<a href="#' . $name . '" role="button" class="btn ' . $class . '" data-toggle="modal">' . $link_title . '</a>';
		$out .= '<div class="modal fade" id="' . $name . '" tabindex="-1" role="dialog" aria-labelledby="' . $name . 'Label" aria-hidden="true">';
		$out .= '<div class="modal-dialog">';
		$out .= '<div class="modal-content">';
		$out .= '<div class="modal-header">';
		$out .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
		$out .= '<h3 id="' . $name . 'Label" class="modal-title">' . $window_title . '</h3>';
		$out .= '</div>';
		$out .= '<div class="modal-body">';
		$out .= $window_content;
		$out .= '</div>';
		$out .= '<div class="modal-footer text-right">';
		$out .= '<a href="' . $target_url . '" class="btn ' . $modal_class . '">OK</a>';
		$out .= '<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">' . $cancel . '</button>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
}

if ( ! function_exists('form_datelabel'))
{
	/**
	 * Date Input Field with Label
	 * 
	 * @param string $name
	 * @param string $label
	 * @param boolean $required
	 * @param string $value
	 * @param array $data
	 * @return string 
	 * @uses _generate_input_label()
	 */
	function form_datelabel($name, $label, $required = FALSE, $value = '', $data = '')
	{
		if (!isset($data['class'])) $data['class'] = '';
		$data['class'] .= ' span2 datepicker';
		
		return _generate_input_label('date', $name, $label, $required, $value, $data);
	}
}

if ( ! function_exists('form_textarealabel'))
{
	function form_textarealabel($name, $label, $value = '', $rows = 10, $data = '')
	{
		if (empty($data))
                    $defaults = array('name' => $name,'class' => "input-xxlarge",'id' => $name, 'value' => set_value($name, $value), 'rows' => $rows);
                else 
                    $defaults = array('name' => $name, 'id' => $name, 'value' => set_value($name, $value), 'rows' => 10);
		
                $output = '<div class="control-group' . ((form_error($name)) ? ' error' : '') . '">';
		$output .= form_label($label, $name, array('class' => 'control-label'));
		$output .= '<div class="controls">';
		
		$output .= form_textarea($defaults, set_value($name, $value), $data);
		
		$output .= form_error($name, '<span class="help-inline">', '</span>');
		$output .= '</div>';
		$output .= '</div>' . "\r\n";
		
		return $output;
	}
}

if ( ! function_exists('form_editorlabel'))
{
	function form_editorlabel($name, $label, $value = '', $rows = 10, $data = '')
	{
          
		if (empty($data))
			$data = 'class="tinymce"';
		else
			$data = preg_replace('/(class\s?=\s?")([^"]+?)"/i', '${1}${2} tinymce"', $data);
		return form_textarealabel($name, $label, $value, $rows, $data);
	}
}

/**
 * Has Error
 * 
 * Returns true if there is an error for a specific form field. This is a helper for the
 * form validation class.
 * 
 * @param string|array
 * @return boolean
 */
if ( ! function_exists('has_error'))
{
	function has_error($field)
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		if ($OBJ->has_error($field))
			return ' has-error';
		else
			return '';
	}
}

/**
 * Form Error
 *
 * Returns the error for a specific form field.  This is a helper for the
 * form validation class.
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_error'))
{
	function form_error($field = '')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}

		return $OBJ->error($field, '<label for="' . $field . '" class="error">', '</label>');
	}
}