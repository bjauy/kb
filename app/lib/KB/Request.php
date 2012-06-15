<?php

class KB_Request {

	public static function is_cli() {
		return (PHP_SAPI === 'cli');
	}

	public static function is_ajax() {
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
	}

}
