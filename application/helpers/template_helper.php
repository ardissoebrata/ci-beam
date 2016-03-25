<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Beam-Template Helpers
 * 
 * @package Beam-Template
 * @category Helper
 * @author Ardi Soebrata
 */
/**
 * Beam-Template Helpers
 */
if (!function_exists('messages'))
{
	/**
	 * Return formatted messages.
	 * 
	 * @return string
	 */
	function messages()
	{
		if (FALSE === ($template = & _get_object('template')))
			return '';

		$content = '';
		$template_messages = $template->get_messages();
		
		if (FALSE !== ($form_validation = & _get_object('form_validation')))
		{
			if ($form_validation->num_errors())
				$template_messages['error'][] = sprintf(lang('form_error'), $form_validation->num_errors());
		}

		foreach ($template_messages as $type => $messages)
		{
			if ($type == 'notify')
				continue;
			
			$type_class = $type;
			if ($type == 'error')
				$type_class = 'danger';
			
			$num_messages = count($messages);
			if ($num_messages)
			{
				$content .= "<div class=\"alert alert-danger alert-$type_class  alert-dismissable\">";
				$content .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
				$content .= '<h4>' . lang($type) . '</h4>';
				if ($num_messages > 1)
				{
					$content .= '<ul>';
					foreach ($messages as $message)
					{
						$content .= '<li>' . $message . '</li>';
					}
					$content .= '</ul>';
				}
				else
					$content .= '<p>' . $messages[0] . '</p>';
				$content .= '</div>';
			}
		}
		return $content;
	}

}

if (!function_exists('_get_object'))
{

	/**
	 * Get Object
	 * 
	 * Determines what the class object was instantiated as, fetches
	 * the object and returns it.
	 * 
	 * @param string $obj_name
	 * @return mixed
	 */
	function &_get_object($obj_name)
	{
		$CI =& get_instance();

		// We set this as a variable since we're returning by reference.
		$return = FALSE;

		if (FALSE !== ($object = $CI->load->is_loaded($obj_name)))
		{
			if (!isset($CI->$object) OR ! is_object($CI->$object))
			{
				return $return;
			}

			return $CI->$object;
		}

		return $return;
	}

}