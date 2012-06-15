<?php

class KB_I18n {

	static $lang = 'en_US',
		$instance = null;
	protected static $strings = array();

	public static function set_lang($lang) {

		return self::instance($lang);
		
	}

	public static function instance($lang = 'en_US') {

		if (empty(self::$instance)) {
			self::$instance = new KB_I18n($lang);
		}
		return self::$instance;
	}

	public function __construct($lang) {
		self::$lang = $lang;
		$file = KBAPP. DS. 'i18n'. DS. self::$lang. '.php';
		if (file_exists($file)) {
			require_once($file);
			self::$strings = $text;
			unset($text);			
		}

	}

	public function get($text, $group = 'default') {
		
		if (isset(self::$strings[$group]) && isset(self::$strings[$group][$text])) {
			return self::$strings[$group][$text];
		} else if ($group !== 'default' && isset(self::$strings['default']) && isset(self::$strings['default'][$text])) {
			return self::$strings['default'][$text];
		} else {
			return $text;
		}
	}
}

if (!function_exists('__')) {
	
	function __($text, $group = 'default') {

		$translated = KB_I18n::instance()->get($text, $group);
		
		return $translated;
	
	}
}
