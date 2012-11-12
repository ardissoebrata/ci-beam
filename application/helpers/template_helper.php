<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Beam-Template
 * 
 * @package Beam-Template
 * @category Helper
 * @author Ardi Soebrata
 */

/**
 * Beam-Template URL Helpers
 */
if (!function_exists('assets_url'))
{
	/**
	 * Assets URL
	 * 
	 * Create a URL to assets path.
	 * 
	 * @param string $uri
	 * @return string
	 */
	function assets_url($uri = '')
	{
		$CI =& get_instance();
		$assets_path = $CI->config->item('assets_path', 'beam_template');
		if (! $assets_path) $assets_path = '';
		return $CI->config->base_url($assets_path . '/' . $uri);
	}
}

if (!function_exists('js_url'))
{
	/**
	 * JS URL
	 * 
	 * Create a URL to javascript file.
	 * 
	 * @param string $name Name of the javascript file (without .js).
	 * @return string
	 * @uses assets_url 
	 */
	function js_url($name = '')
	{
		return assets_url('js/' . $name . '.js');
	}
}

if (!function_exists('css_url'))
{
	/**
	 * CSS URL
	 * 
	 * Create a URL to css file.
	 * 
	 * @param string $name Name of the css file (without .css).
	 * @return string
	 * @uses assets_url
	 */
	function css_url($name = '')
	{
		return assets_url('css/' . $name . '.css');
	}
}

if (!function_exists('image_url'))
{
	/**
	 * Image URL
	 * 
	 * Create a URL to image file.
	 * 
	 * @param string $filename Filename (with extension) of the image file.
	 * @return string
	 * @uses assets_url 
	 */
	function image_url($filename = '')
	{
		return assets_url('img/' . $filename);
	}
}

if (!function_exists('messages'))
{
	function messages()
	{
		if (FALSE === ($template =& _get_object('template')))
			return '';
		
		$content = '';
		$template_messages = $template->get_messages();
		
		if (FALSE !== ($form_validation =& _get_object('form_validation')))
		{
			if ($form_validation->num_errors()) 
				$template_messages['error'][] = sprintf(lang('form_error'), $form_validation->num_errors());
		}
		
		foreach($template_messages as $type => $messages)
		{
			if ($type == 'notify') continue;
			$num_messages = count($messages);
			if ($num_messages)
			{
				$content .= "<div class=\"alert alert-block alert-$type\">";
				$content .= '<button type="button" class="close" data-dismiss="alert">×</button>';
				$content .= '<h4>' . lang($type) . '</h4>';
				if ($num_messages > 1)
				{
					$content .= '<ul>';
					foreach($messages as $message)
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

if ( ! function_exists('_get_object'))
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
			if ( ! isset($CI->$object) OR ! is_object($CI->$object))
			{
				return $return;
			}
			
			return $CI->$object;
		}
		
		return $return;
	}
}