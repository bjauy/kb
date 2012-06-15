<?php

class KB_Query {

	protected $dbh = null;
	protected $table = '';
	protected static $instance = null;

	public static function instance($table = '') {
		if (self::$instance === null) {
			self::$instance = new KB_Query($table);
		}
		return self::$instance;
	}
	public function __construct($table = '') {		
		$this->dbh = new PDO('sqlite:'. KBDATA. '/kb.db');
		$this->table = $table;
	}

	public function query($query_string) {

		return $this->dbh->query($query_string);
		
	}

	public function insert($values = null) {

		$vals = '('. implode(', ', array_keys($values)). ') VALUES("'. implode('", "', array_values($values)). '")';
		$rows = $this->dbh->exec('INSERT INTO '. $this->table. $vals);
		if ($rows !== false) {
			return $this->dbh->lastInsertId();
		} else {
			return false;
		}
		
	}

	public function update($values = null, $where = null) {

		$vals = $this->_prepare_values($values);
		if (is_numeric($where)) {
			$where = ' id = '. $where;
		}

		return $this->dbh->exec('UPDATE '. $this->table. ' SET '. $vals. 'WHERE '. $where);
	}

	public function select($columns = '*', $where = null, $other = '') {
		$ret = array();
		if (is_numeric($where)) {
			$where = ' id = '. $where;
		} else if (is_null($where)) {
			$where = '1=1';
		}
		$res = $this->dbh->query('SELECT '. $columns. ' FROM '. $this->table. ' WHERE '. $where. (!empty($other) ? ' '.$other : ''));
		if (!$res) {
			return false;
		}
		while (($tmp_obj = $res->fetchObject()) !== false) {
			$ret[] = $tmp_obj;
		}
		return $ret;
	}

	protected function _prepare_values($values) {

		$ret = '';

		foreach ($values as $var => $val) {
			if (is_string($val)) {
				$val = '"'.$val.'"';
			}
			$ret .= ', '. $var. ' = '. $val;
		}
		return ltrim($ret, ', ').' ';
	}

}
