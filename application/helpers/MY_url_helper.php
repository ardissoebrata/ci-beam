<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Beam-Template URL Helpers
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
		$CI = & get_instance();
		$assets_path = $CI->config->item('assets_path', 'template');
		if (!$assets_path)
			$assets_path = '';
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
		if (!preg_match("/\.js$/i", $name))
		{
			$name .= '.js';
		}
		return assets_url('js/' . $name);
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
		if (!preg_match("/\.css$/i", $name))
		{
			$name .= '.css';
		}
		return assets_url('css/' . $name);
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

if (!function_exists('bower_url'))
{

	/**
	 * Bower URL
	 * 
	 * Create a URL to bower_components files.
	 * 
	 * @param string $file Filename path (with extension) of the file relative to assets/bower_components.
	 * @return string
	 * @uses assets_url 
	 */
	function bower_url($file = '')
	{
		return assets_url('bower_components/' . $file);
	}

}