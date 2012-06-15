<?php

class KB_Response {
	public static $statuses = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		507 => 'Insufficient Storage',
		509 => 'Bandwidth Limit Exceeded'
	);
	static $instance = null;

	public static function instance($body = null, $status = 200, array $headers = array())
	{
		if (!self::$instance) {
			self::$instance = new KB_Response($body, $status, $headers);
		
		}
		return self::$instance;
	}

	public static function redirect($url = '', $method = 'location', $code = 302)
	{
		$response = new KB_Response();

		$response->set_status($code);

		if ($method == 'location')
		{
			$response->set_header('Location', $url);
		}
		elseif ($method == 'refresh')
		{
			$response->set_header('Refresh', '0;url='.$url);
		}
		else
		{
			return;
		}

		$response->send(true);
		exit;
	}

	public $status = 200;

	public $headers = array();

	public $body = null;

	public function __construct($body = null, $status = 200, array $headers = array())
	{
		foreach ($headers as $k => $v)
		{
			$this->set_header($k, $v);
		}
		$this->body = $body;
		$this->status = $status;
	}

	public function set_status($status = 200)
	{
		$this->status = $status;
		return $this;
	}

	public function set_header($name, $value, $replace = true)
	{
		if ($replace)
		{
			$this->headers[$name] = $value;
		}
		else
		{
			$this->headers[] = array($name, $value);
		}

		return $this;
	}

	public function get_header($name = null)
	{
		if (func_num_args())
		{
			return isset($this->headers[$name]) ? $this->headers[$name] : null;
		}
		else
		{
			return $this->headers;
		}
	}

	public function body($value = false)
	{
		if ($value === false)
		{
			return $this->body;
		}
		$this->body = $value;
		return $this;
	}

	public function send_headers()
	{
		if ( !headers_sent())
		{
			header(($_SERVER['SERVER_PROTOCOL'] ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1').' '.$this->status.' '. self::$statuses[$this->status]);
			
			foreach ($this->headers as $name => $value)
			{
				is_int($name) and is_array($value) and list($name, $value) = $value;

				is_string($name) and $value = "{$name}: {$value}";

				header($value, true);
			}
			return true;
		}
		return false;
	}

	public function send($send_headers = false)
	{
		$send_headers and $this->send_headers();

		if ($this->body != null)
		{
			echo $this->body;
		}
	}

	public function __toString()
	{
		return (string) $this->body();
	}
}

