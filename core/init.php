<?php
ob_start();
session_start();
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'angelFarmBase'

	),
	'remember' => array(
		'cookie_name' => 'angHash',
		'cookie_expiry' => '604800'
	),
	'session' => array(
		'session_admin' => 'angAdmin',
		'session_user' => 'angUser',
		'token_name' => 'token'
	)
);

//APP ROOT
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT

define('URLROOT', 'http://localhost/algroTool/');

//SITE NAME
define('SITENAME', 'Angel Farm');
define('APPVERSION', '1.0.0');
define('ADMIN', 'CONTROL ROOM');
define('NAVNAME', 'AF');
define('DASHBOARD', 'AF Panel');
// define('EMAIL', 'youremail@gmail.com');
// define('PASSWORD', 'passwaord\\\===\\\@');
// define('AUDIOPATH', 'uploads/sermon/');




spl_autoload_register(function ($class) {
	require_once(APPROOT . '/classes/' . $class . '.php');
});


require_once(APPROOT . '/helpers/session_helper.php');
require_once(APPROOT . '/helpers/session.php');
ob_clean();