<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Beam-Template
 * 
 * @package Beam-Template
 * @category Config
 * @author Ardi Soebrata
 */
/**
 * Beam-Template Configuration.
 */

/**
 * Path to Template Layout.
 * 
 * Default: 'application/views/layouts' 
 */
$config['template']['layout_path'] = 'layouts';

/**
 * Default Template Layout
 * 
 * The default layout to use 
 * Default: 'default'
 */
$config['template']['default_layout'] = 'default';

/**
 * Path to Assets
 * 
 * Path to your assets files, default to 'assets'.
 */
$config['template']['assets_path'] = 'assets';

/**
 * Default Site Title
 */
$config['template']['base_title'] = 'My Site';

/**
 * Title Separator 
 */
$config['template']['title_separator'] = ' | ';

/*
 * Supported Languages
 * 
 */
$config['template']['languages'] = array(
	'en' => array('name' => 'English', 'folder' => 'english'),
	'id' => array('name' => 'Bahasa Indonesia', 'folder' => 'indonesian')
);

/**
 * Default Site Metas
 */
$config['template']['metas'] = array(
	'description'	=> 'My Site description',
	'author'		=> 'Me',
	'viewport'		=> 'width=device-width, initial-scale=1'
);

/**
 * Default CSS 
 */
$config['template']['css'] = array();

/**
 * Default Javascript
 */
$config['template']['js_header'] = array();
$config['template']['js_footer'] = array();