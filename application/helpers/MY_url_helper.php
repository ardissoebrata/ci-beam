<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Current URL params
 *
 * Returns the full URL (including segments and gets parameters) of the page where this
 * function is placed
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('current_url_params'))
{
	function current_url_params($params = array())
	{
		$CI =& get_instance();
		$site_url = $CI->config->site_url($CI->uri->uri_string());
		
		$gets = $CI->input->get();
		if (! $gets) 
			$gets = array();
		if (count($params) > 0)
			$gets = array_merge($gets, $params);
		
		$params = array();
		foreach($gets as $key => $value)
			$params[] = $key . '=' . $value;
		$site_url .= '?' . implode('&', $params);
		
		return $site_url;
	}
}

// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect'))
{
	function redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = site_url($uri);
		}
		
		if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
			exit('Redirect to ' . anchor($uri, '', array('class' => 'redirect-link')));
		else
		{
			switch($method)
			{
				case 'refresh'	: header("Refresh:0;url=".$uri);
					break;
				default			: header("Location: ".$uri, TRUE, $http_response_code);
					break;
			}
			exit;
		}
	}
}