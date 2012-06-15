<?php

class KB_Exception extends Exception {

	public static function output(Exception $e) {
		KB_Response::instance(KB_View::template('errors/500', array('error' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile())), 500);
		exit();
    }
  
    public static function handle_exception(Exception $e)
    {
         self::output($e);
    }
	

}
