<?php

require_once './system/modification/system/environment.php';

// HTTP
define('HTTP_SERVER', 'http://sandbox.opencart.tst/');

// HTTPS
define('HTTPS_SERVER', 'http://sandbox.opencart.tst/');

// DIR
define('DIR_REPOSITORY', 	'./repository/');
define('DIR_APPLICATION', 	'./catalog/');
define('DIR_SYSTEM', 		'./system/');
define('DIR_LANGUAGE', 		'./catalog/language/');
define('DIR_TEMPLATE', 		'./catalog/view/theme/');
define('DIR_CONFIG', 		'./system/config/');
define('DIR_MODIFICATION', 	'./system/modification/');
define('DIR_IMAGE', 		environment::getImageDirectory());
define('DIR_CACHE', 		environment::getCacheDirectory());
define('DIR_DOWNLOAD', 		environment::getDownloadDirectory());
define('DIR_LOGS', 			environment::getLogsDirectory());

// DB
define('DB_DRIVER', 		'mysqli');
define('DB_HOSTNAME', 		'localhost');
define('DB_USERNAME', 		'root');
define('DB_PASSWORD', 		'');
define('DB_DATABASE', 		'opencart_mt_01');
define('DB_PREFIX', 		'');
