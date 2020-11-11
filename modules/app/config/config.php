<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$appEnvConfigFile = APP_PATH . '/config/config_'.APP_ENV.'.php';
if(defined('PTOOLSPATH')){
    $appEnvConfigFile = APP_PATH . '/config/config_webtool.php';
}
if(!is_file($appEnvConfigFile)){
    die('application environment config file not found: '.$appEnvConfigFile);
}
$config = include($appEnvConfigFile);
// die(json_encode($config));
return new \Phalcon\Config($config);
