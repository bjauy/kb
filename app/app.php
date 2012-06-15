<?php
define('DS', DIRECTORY_SEPARATOR);

require_once(KBAPP. DS. 'lib'. DS. 'KB'. DS. 'autoloader.php');
KB_Autoloader::register();

set_exception_handler(array('KB_Exception', 'handle_exception'));

session_start();

KB_Config::set('theme', 'rect'); // possible values - default, rect
KB_I18N::set_lang('pl_PL');

try {
	if (KB_Request::is_cli()) {
		global $argv;
		$handler = new KB_Handler_CLI($argv);
	} else {
		$handler = new KB_Handler_Web();
	}
	$response = $handler->act();

	KB_Response::instance($response)->send(true);
} catch (Exception $e) {
		KB_Exception::handle_exception($e);
}

