<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$template_conf = array(
	'template' => 'default',
//	'site_name' => 'Site Name',
//	'site_title' => 'Some slogan here',
	'devmode' => false,
	'content' => '',
	'css' => '',
	'js' => '',
	'head' => '',
	'messages' => '',
	'assets_dir' => 'resource/',
	'set_page_title' => true
);

$template_css = array('style');

$template_js = array();

$template_head = array(
//	'jquery' => '<script type="text/javascript" src="http://www.google.com/jsapi"></script>
//					<script type="text/javascript">
//					google.load("jquery", "1.6.0");
//					</script>',
	'jquery' => '<script type="text/javascript" src="resource/js/jquery-1.5/jquery-1.5.js"></script>',
//	'960gs' => '<link type="text/css" rel="stylesheet" href="resource/css/960gs/960gs.css" />',
//	'bootstrap' => '<link rel="stylesheet" href="resource/css/twitter-bootstrap/bootstrap.css">',
	'bootstrap-less' => '<link rel="stylesheet/less" type="text/css" href="resource/css/twitter-bootstrap/lib/bootstrap.less">',
	'less-js' => '<script src="resource/js/less-1.1.5.min.js" type="text/javascript"></script>',
);