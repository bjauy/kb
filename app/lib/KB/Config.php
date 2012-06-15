<?php

class KB_Config {

	public static function set($var, $val = null) {
		$_SESSION['KB'][$var] = $val;
	}
	
	public static function get($var, $default_val = null) {
		return isset($_SESSION['KB'][$var]) ? $_SESSION['KB'][$var] : $default_val;
	}
}
