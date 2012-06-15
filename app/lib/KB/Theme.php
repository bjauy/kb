<?php

class KB_Theme {

	static function get_stylesheets($stylesheets) {

		if (($sfx = KB_Config::get('theme', 'default')) === 'default') {
			return $stylesheets;
		} 
		$ret = array();
		foreach ($stylesheets as $file => $data) {			
			$new_file = str_ireplace(array('.css', '.less'), array('_'. $sfx. '.css', '_'. $sfx. '.less'), $file);
			if (file_exists(KBWEB. DS. 'assets'. DS. 'css'. DS. $new_file)) {
				$file = $new_file;
				$data['title'] = ucfirst($sfx);
			}
			$ret[$file] = $data;
		}
		return $ret;
	}
	
}
