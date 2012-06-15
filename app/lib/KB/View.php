<?php

class KB_View {

	public static function template($name, $vars = array()) {

		$filename = KBAPP. DS. 'views'. DS. str_replace('/', DS, $name). '_'. (KB_Config::get('theme', 'default')). '.php';

		if (!file_exists($filename)) {
			$filename = KBAPP. DS. 'views'. DS. str_replace('/', DS, $name). '.php';
		}

		if (file_exists($filename)) {
			ob_start();
			foreach ($vars as $k => $v) {
				$$k = $v;
			}
			require_once($filename);
			return ob_get_clean();
		} else {
			throw new KB_Exception ('No template named <strong>'. $name. '</strong>');
		}
		
	}
}
