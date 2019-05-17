<?php
require_once '../system/library/environment.php';
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'master');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
class ControllerStartupDatabase extends Controller {
	public function index() {
		if (is_file(DIR_OPENCART . 'config.php') && filesize(DIR_OPENCART . 'config.php') > 0) {
			$lines = file(DIR_OPENCART . 'config.php');
			
			foreach ($lines as $line) {
				if (strpos(strtoupper($line), 'DB_') !== false) {
					eval($line);
				}
			}
			
			if (defined('DB_PORT')) {
				$port = DB_PORT;
			} else {
				$port = ini_get('mysqli.default_port');
			}
			
			$this->registry->set('db', new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, $port));
		}
	}
}