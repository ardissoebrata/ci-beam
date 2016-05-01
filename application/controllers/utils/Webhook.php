<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller
{

	/**
	 * The name of the file that will be used for logging deployments. Set to 
	 * FALSE to disable logging.
	 * 
	 * @var string
	 */
	private $_log = 'deploy';

	/**
	 * The timestamp format used for logging. Keep empty to use setting from config.
	 * 
	 * @link    http://www.php.net/manual/en/function.date.php
	 * @var     string
	 */
	private $_date_format = '';

	/**
	 * The name of the branch to pull from.
	 * 
	 * @var string
	 */
	private $_branch = 'master';

	/**
	 * The name of the remote to pull from.
	 * 
	 * @var string
	 */
	private $_remote = 'origin';

	function index()
	{
		$payload = $this->input->post('payload');  // old method
		if (empty($payload)) {
			$payload = json_decode(file_get_contents('php://input'));
		}

		if (!empty($payload)) {

			$deploy_branch = $this->config->item('deploy_branch');
			if ($deploy_branch)
				$this->_branch = $deploy_branch;

			$this->log('Deployment Environment : ' . ENVIRONMENT);
			$this->log('Incoming IP : ' . $this->input->ip_address());
			$this->log('Branch : ' . $this->_branch);
			$this->log('Attempting deployment...');

			try {
				// Make sure we're in the right directory
				chdir(realpath(FCPATH) . DIRECTORY_SEPARATOR);
				$this->log("Changing working directory to " . FCPATH);

				// Discard any changes to tracked files since our last deploy
				$reset_output = array();
				exec("git reset --hard HEAD 2>&1", $reset_output);
				$this->log("Reseting repository... " . implode("\n", $reset_output));

				// Update the local repository
				$this->log('Branch : ' . $this->_branch);
				$pull_output = array();
				exec('git pull ' . $this->_remote . ' ' . $this->_branch . " 2>&1", $pull_output);
				$this->log("Pulling in changes... " . implode("\n", $pull_output));

				// Secure index.php
				chmod(FCPATH . DIRECTORY_SEPARATOR . 'index.php', 0755);

				// Update composer
				$composer_output = array();
				exec("php composer.phar install 2>&1", $composer_output);
				$this->log("Updating composer... " . implode("\n", $composer_output));

				$this->log('Deployment successful.');
			} catch (Exception $e) {
				$this->log($e, 'ERROR');
			}
		}
	}

	/**
	 * Writes a message to the log file.
	 * 
	 * @param  string  $message  The message to write
	 * @param  string  $type     The type of log message (e.g. INFO, DEBUG, ERROR, etc.)
	 */
	public function log($message, $type = 'INFO')
	{
		if ($this->_log) {
			// Set the log file path
			$log_path = $this->config->item('log_path');
			if (!$log_path)
				$log_path = APPPATH . 'logs/';
			if (!is_dir($log_path) OR ! is_really_writable($log_path))
				return FALSE;

			// Set the name of the log file
			$filename = $log_path . $this->_log . '-' . date('Y-m-d') . '.php';

			if (!file_exists($filename)) {
				// Create the log file
				file_put_contents($filename, "<" . "?php defined('BASEPATH') OR exit('No direct script access allowed'); ?" . ">\n\n");

				// Allow anyone to write to log files
				chmod($filename, 0666);
			}

			$date_fmt = $this->_date_format;
			if (!$date_fmt)
				$date_fmt = $this->config->item('log_date_format');
			if (!$date_fmt)
				$date_fmt = 'Y-m-d H:i:s';

			// Write the message into the log file
			// Format: type - time --> message
			file_put_contents($filename, $type . ' - ' . date($date_fmt) . ' --> ' . $message . PHP_EOL, FILE_APPEND);
		}
	}

}
