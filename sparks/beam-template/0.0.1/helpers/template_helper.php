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