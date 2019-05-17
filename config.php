<?php
require_once './system/library/environment.php';
$env = new environment();
// HTTP
define('HTTP_SERVER', 'http://' . $env->getDomain() . "/" . $env->scriptpath);

// HTTPS
define('HTTPS_SERVER', 'http://' . $env->getDomain() . "/" . $env->scriptpath);

// DIR
define('DIR_APPLICATION', 'C:/xampp/htdocs/oc/catalog/');
define('DIR_SYSTEM', 'C:/xampp/htdocs/oc/system/');
define('DIR_IMAGE', $env->getTenantDirectory() . 'image/'); // Custom
define('DIR_STORAGE', $env->getTenantDirectory() . 'storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', $env->getTenantDirectory() . 'cache/');
define('DIR_DOWNLOAD', $env->getTenantDirectory() . 'download/');
define('DIR_LOGS', $env->getTenantDirectory() . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', $env->getTenantDirectory() . 'session/');
define('DIR_UPLOAD', $env->getTenantDirectory() . 'upload/');
require $env->getTenantDirectory() . 'config.php';
