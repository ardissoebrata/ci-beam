<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Layout Path
|--------------------------------------------------------------------------
|
| Relative path to layouts directory, default to application/views/layouts directory.  
| Use a relative path from views directory without trailing slash.
|
*/
$config['template']['layout_path'] = 'layouts';

/*
|--------------------------------------------------------------------------
| Assets Path
|--------------------------------------------------------------------------
|
| Relative path to assets directory, default to '/assets' directory.  
| Use a relative path from root directory without trailing slash.
|
*/
$config['template']['assets_path'] = 'assets';

/*
|--------------------------------------------------------------------------
| Default Template Layout
|--------------------------------------------------------------------------
|
| Default layout name to use if you not specify any layout.
| Default to 'default' layout.
|
*/
$config['template']['default_layout'] = 'default';

/*
|--------------------------------------------------------------------------
| Base Site Title
|--------------------------------------------------------------------------
|
*/
$config['template']['base_title'] = 'My Site';

/*
|--------------------------------------------------------------------------
| Title Separator
|--------------------------------------------------------------------------
|
| What to separate base title from page title if you set the page title. 
| ex: $this->template->set_title('Page One');
| result: 'Page One | My Site'
|
*/
$config['template']['title_separator'] = ' | ';

/*
|--------------------------------------------------------------------------
| Languages
|--------------------------------------------------------------------------
|
| List of languages that your application support.
|
*/
$config['template']['languages'] = array(
	'en' => array('name' => 'English', 'folder' => 'english'),
	'id' => array('name' => 'Bahasa Indonesia', 'folder' => 'indonesian')
);

/*
|--------------------------------------------------------------------------
| Default Metas
|--------------------------------------------------------------------------
|
| List of meta tags that will appear on every head section of your views.
|
*/
$config['template']['metas'] = array(
	'description'	=> 'My Site description',
	'author'		=> 'Me',
	'viewport'		=> 'width=device-width, initial-scale=1'
);

/*
|--------------------------------------------------------------------------
| Default CSS
|--------------------------------------------------------------------------
|
| List of CSS styles that will appear on every views.
|
*/
$config['template']['css'] = array();

/*
|--------------------------------------------------------------------------
| Default JS
|--------------------------------------------------------------------------
|
| List of javascripts that will appear on every views.
|
*/
$config['template']['js_header'] = array();
$config['template']['js_footer'] = array();

/*
|--------------------------------------------------------------------------
| Dashboard URI
|--------------------------------------------------------------------------
|
| Where to go if a user login without specifying any url.
|
*/
$config['template']['dashboard_uri'] = 'dashboard/home';
