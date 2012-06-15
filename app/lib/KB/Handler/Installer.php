<?php

class KB_Handler_Installer {

	public function act() {

		if (KB_Request::is_ajax() === true) {
			$ret = KB_Query::instance()->query('CREATE TABLE IF NOT EXISTS "main"."entries" (
				"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , 
				"date_add" DATETIME DEFAULT CURRENT_TIMESTAMP, 
				"name" CHAR, 
				"body" TEXT, 
				"author_id" INTEGER, 
				"tags" CHAR)');
			$err = $ret && $ret->errorInfo();
			if ($err[0] !== 1) {
				file_put_contents(KBDATA. DS. '.installed', '1');
				return '<h4 class="message">Install completed!</h4>';
			} else {
				return '<h4 class="message">Install failed:</h4><div class="message">'.print_r($err, true).'</div>';
			}

			
		}
		return KB_View::template('_installer', array('requirements' => $this->_get_requirements()));

	}

	protected function _get_requirements() {
		//@todo: writable /data, enabled SQLite,
		return array(
			'PHP 5.2' => defined('PHP_MINOR_VERSION') && defined('PHP_MAJOR_VERSION') && ((PHP_MINOR_VERSION >= 2 && PHP_MAJOR_VERSION === 5) || PHP_MAJOR_VERSION > 5),	
		);
	}


}
