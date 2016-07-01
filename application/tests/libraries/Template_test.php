<?php

class Template_test extends TestCase {
	
	private static $ci;
	private $obj;
	
	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();
		
		self::$ci =& get_instance();
	}
	
	public function setUp()
	{
		parent::setUp();
		
		//Setup config
		self::$ci->config->set_item('template', array(
			'layout_path' => 'layouts',
			'default_layout' => 'test_default',
			'assets_path' => 'assets',
			'base_title' => 'My Site',
			'title_separator' => ' | ',
			'metas' => array(
				'description'	=> 'My Site description',
				'author'		=> 'Me',
				'viewport'		=> 'width=device-width, initial-scale=1'
			)
		));
		$this->obj = new Template();
	}
	
	public function test_config_setting_is_loaded() 
	{
		$this->assertEquals('test_default', $this->obj->get_layout());
	}
	
	public function test_template_is_build()
	{
		$output = $this->obj->build('layouts/test_view', array(), TRUE);
		$this->assertContains('Your Company 2014', $output);
	}
	
	public function test_title_is_generated()
	{
		$output = $this->obj->set_title('Test Title')->build('layouts/test_view', array(), TRUE);
		$this->assertContains('Test Title | My Site', $output);
	}
	
	public function test_meta_is_generated()
	{
		$output = $this->obj->build('layouts/test_view', array(), TRUE);
		$this->assertContains('<meta name="description" content="My Site description" />', $output);
		$this->assertContains('<meta name="author" content="Me" />', $output);
		$this->assertContains('<meta name="viewport" content="width=device-width, initial-scale=1" />', $output);
	}
	
	public function test_css_is_generated()
	{
		$output = $this->obj
				->set_css('some_css')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains('<link href="' . css_url('some_css') . '" rel="stylesheet" media="screen" />', $output);
	}
	
	public function test_css_url_is_generated()
	{
		$output = $this->obj
				->set_css('http://some.com/some_css.css')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains('<link href="http://some.com/some_css.css" rel="stylesheet" media="screen" />', $output);
	}
	
	public function test_css_style_is_generated()
	{
		$output = $this->obj
				->set_css_style('body { padding: 5px; }')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<style>\r\nbody { padding: 5px; }\r\n\t\t</style>\r\n", $output);
	}
	
	public function test_js_header_is_generated()
	{
		$output = $this->obj
				->set_js('some_js', FALSE)
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script src=\"" . js_url('some_js') . "\"></script>\r\n</head>", $output);
	}
	
	public function test_js_header_url_is_generated()
	{
		$output = $this->obj
				->set_js('http://some.com/some_js.js', FALSE)
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script src=\"http://some.com/some_js.js\"></script>\r\n</head>", $output);
	}
	
	public function test_js_header_script_is_generated()
	{
		$output = $this->obj
				->set_js_script('var base_url = \'' . base_url() . '\';', 'some_js', FALSE)
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script>\r\nvar base_url = '" . base_url() . "';\r\n</script>\r\n</head>", $output);
	}
	
	public function test_js_footer_is_generated()
	{
		$output = $this->obj
				->set_js('some_js')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script src=\"" . js_url('some_js') . "\"></script>\r\n\r\n</body>", $output);
	}
	
	public function test_js_footer_url_is_generated()
	{
		$output = $this->obj
				->set_js('http://some.com/some_js.js')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script src=\"http://some.com/some_js.js\"></script>\r\n\r\n</body>", $output);
	}
	
	public function test_js_footer_script_is_generated()
	{
		$output = $this->obj
				->set_js_script('var base_url = \'' . base_url() . '\';', 'some_js')
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains("\t\t<script>\r\nvar base_url = '" . base_url() . "';\r\n</script>\r\n\r\n</body>", $output);
	}
	
	public function test_messages_are_generated()
	{
		$this->obj->add_message('warning', 'Warning message test.')
				->add_message('error', 'Error message test.')
				->add_message('success', 'Success message test.')
				->add_message('info', 'Info message test.');
		
		$output = $this->obj->build('layouts/test_view', array(), TRUE);
		
		$this->assertContains("<li>warning : Warning message test.</li>", $output);
		$this->assertContains("<li>error : Error message test.</li>", $output);
		$this->assertContains("<li>success : Success message test.</li>", $output);
		$this->assertContains("<li>info : Info message test.</li>", $output);
	}
	
	public function test_flash_messages_are_generated()
	{
		$this->obj->set_flashdata('warning', 'Warning message test.')
				->set_flashdata('error', 'Error message test.')
				->set_flashdata('success', 'Success message test.')
				->set_flashdata('info', 'Info message test.');
		
		$output = $this->obj->build('layouts/test_view', array(), TRUE);
		
		$this->assertContains('<li>warning : Warning message test.</li>', $output);
		$this->assertContains('<li>error : Error message test.</li>', $output);
		$this->assertContains('<li>success : Success message test.</li>', $output);
		$this->assertContains('<li>info : Info message test.</li>', $output);
	}
	
	public function test_content_is_generated()
	{
		$output = $this->obj->build('layouts/test_view', array(), TRUE);
		$this->assertContains('<h1>Test View</h1>', $output);
	}
	
	public function test_partial_content_is_generated()
	{
		$output = $this->obj->load_partial('partial_content', "\r\n<h2>Partial Test</h2>\r\n<p>This page is used by unit testing. Don\'t touch this.</p>\r\n")
				->build('layouts/test_view', array(), TRUE);
		$this->assertContains('<h2>Partial Test</h2>', $output);
	}
}
