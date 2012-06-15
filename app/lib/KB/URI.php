<?php

class KB_URI {

	public static function parse() {

		$ret = array();
		$req = ltrim($_SERVER['REQUEST_URI'], '/');

		$reqs = explode('/', $req); 

		$ret['action'] = $reqs[0];
		$i = 1;
		while ($i < count($reqs)) {
			if (in_array($reqs[$i], array('id', 'tag'))) {
				$ret[$reqs[$i]] = isset($reqs[$i+1]) ? $reqs[$i+1] : null;
				$i++;
			} else {
				$ret['params'][] = $reqs[$i];
			}
			$i++;
		}

		return $ret;
	}
}
