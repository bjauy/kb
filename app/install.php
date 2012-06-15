<?php

define('DS', DIRECTORY_SEPARATOR);

require_once(KBAPP. DS. 'lib'. DS. 'KB'. DS. 'autoloader.php');
KB_Autoloader::register();

set_exception_handler(array('KB_Exception', 'handle_exception'));

try {
	$handler = new KB_Handler_Installer();

	KB_Response::instance($handler->act())->send(true);
} catch (Exception $e) {
		KB_Exception::handle_exception($e);
}


