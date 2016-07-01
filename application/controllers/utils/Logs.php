<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Jenssegers\Date\Date;

/**
 * Display Log Files.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class Logs extends Admin_Controller
{

	protected $mode_settings = array(
		'system' => array(
			'prefix' => 'log',
			'pattern' => "|(.*)\s-\s(\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d)\s-->\s(.*)|i",
			'columns' => array('level', 'time', 'message'),
			'widths' => array(70, 90, 0)
		),
		'deploy' => array(
			'prefix' => 'deploy',
			'pattern' => "|(.*)\s-\s(\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d)\s-->\s(.*)|i",
			'columns' => array('level', 'time', 'message'),
			'widths' => array(70, 90, 0)
		)
	);

	/**
	 * Redirect to index if cancel-button clicked.
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->language('logs');
		$this->load->helper('form');
	}

	function system()
	{
		$this->load->vars('panel_title', lang('log_system'));

		$this->_display_log('system');
	}

	function deploy()
	{
		$this->load->vars('panel_title', lang('log_deploy'));

		$this->_display_log('deploy');
	}

	function _display_log($mode)
	{
		$setting = $this->mode_settings[$mode];
		$this->load->vars('setting', $setting);

		$log_path = $this->config->item('log_path');
		if (!$log_path)
			$log_path = APPPATH . 'logs/';

		$prefix = $setting['prefix'];

		$log_files = array();
		if (is_dir($log_path)) {
			foreach (glob($log_path . $prefix . "-*.php") as $filename) {
				$datestr = substr($filename, -14, 10);
				$log_files[$datestr] = Date::createFromFormat('Y-m-d', $datestr)->format('d F Y');
			}
		}
		$this->load->vars('log_files', array_reverse($log_files));

		$selected_log = $this->input->get('log_date', FALSE);
		if (!$selected_log || empty($selected_log)) {
			$values = array_keys($this->load->get_var('log_files'));
			if (is_array($values) && isset($values[0]))
				$selected_log = $values[0];
		}
		$this->load->vars('selected_log', $selected_log);

		$rows = array();
		$filename = $log_path . $prefix . '-' . $selected_log . '.php';
		if (file_exists($filename)) {
			$fh = fopen($filename, 'r');
			$row = array();
			while ($line = fgets($fh)) {
				$match = array();
				if (preg_match($setting['pattern'], trim($line), $match)) {
					if (!empty($row))
						$rows[] = $row;
					$row = array();
					foreach ($setting['columns'] as $index => $column) {
						if ($column == 'time')
							$row[$column] = substr($match[$index + 1], -8);
						else
							$row[$column] = nl2br($match[$index + 1]);

						if ($column == 'username') {
							$user = $this->user_model->get_by_username($row['username']);
							if ($user)
								$row['full_name'] = $user->full_name;
							else
								$row['full_name'] = '-';
						}
					}
				}
				elseif (!empty($row) && isset($row['message']))
					$row['message'] .= '<br />' . $line;
			}
			if (!empty($row))
				$rows[] = $row;
			fclose($fh);
		}
		$this->load->vars('rows', $rows);

		$this->template
				->set_js_script('
$(document).ready(function() {
	$(\'[name=log_files]\').change(function() {
		location.href = \'' . site_url('utils/logs/' . $mode) . '?log_date=\' + $(this).val();
	});
});
', 'log', TRUE)
				->build('utils/logs');
	}

}
