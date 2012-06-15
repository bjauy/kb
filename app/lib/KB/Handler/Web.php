<?php

class KB_Handler_Web {

	protected $title = '',
			$content = '',
			$styles = array(),
			$scripts = array('less-1.3.0.min.js', 'jquery-1.7.2.min.js', 'script.js');

	protected $decorate = true;

	public function __construct() {		
		if (KB_Request::is_ajax() === true) {
			$this->decorate = false;
		} else {
			$this->styles = KB_Theme::get_stylesheets(array('style.less' => array('rel' => 'stylesheet/less', 'type' => 'text/css', 'title' => 'Default', 'media' => 'all')));
		}
	}
	
	public function action_list($params) {

		$this->title = 'All entries';
		$pager = null;
		$filter = $this->_filter($params);
		
		$entries = KB_Query::instance('"main"."entries"')->select('*', '1 = 1'. $filter);
		return KB_View::template('_list', array('entries' => $entries, 'pager' => $pager));
	}

	protected function _filter($params) {
		$ret = '';
		if (isset($params['tag'])) {
			$ret .= ' AND tags LIKE "%'. $params['tag']. '%"';
			$this->title .= ', tagged: '. $params['tag'];
		}
		return $ret;
	}

	public function action_search() {
		if (!empty($_POST['query'])) {
			if (KB_Request::is_ajax()) {
				$results = KB_Query::instance('"main"."entries"')->select('*', 'name LIKE "%'. $_POST['query']. '%" OR body LIKE "%'. $_POST['query']. '%" OR tags LIKE "%'. $_POST['query']. '%"');
				return KB_View::template('search/results', array('results' => $results, 'query' => $_POST['query']));
			} else {
				return KB_View::template('search/no_results');
			}
		} else {
			return false;
		}
	}

	public function action_add() {

		$form = new stdClass();
		$this->title = 'Add entry';
		if ($_POST) {
			if (!empty($_POST['name']) && !empty($_POST['body'])) {
				$new_id = KB_Query::instance('"main"."entries"')->insert(array('name' => $_POST['name'], 'body' => $_POST['body'], 'tags' => isset($_POST['tags']) ? $_POST['tags'] : ''));				
				if ($new_id) {
					KB_Response::redirect('/edit/id/'. $new_id);
				} else {

				}
			}
		
			foreach (array('name', 'body', 'tags') as $field) {
				if (!empty($_POST[$field])) {
					$form->$field = $_POST[$field];
				}
			}		
		
		}
		return KB_View::template('_form', array('form' => $form));
	}

	public function action_edit($params) {

		$form = null;
		$this->title = 'Edit entry';
		if ($_POST) {
			if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['body'])) {
				$ret = KB_Query::instance('"main"."entries"')->update(array('name' => $_POST['name'], 'body' => $_POST['body'], 'tags' => isset($_POST['tags']) ? $_POST['tags'] : ''), $_POST['id']);				
				if ($ret) {
					KB_Response::redirect('/edit/id/'. $params['id']);
				}

			}
			
		} 
	
		$form = KB_Query::instance('"main"."entries"')->select('*', 'id='. $params['id']);

		$form = $form[0];

		if ($_POST) {
			foreach (array('name', 'body', 'tags') as $field) {
				if (!empty($_POST[$field])) {
					$form->$field = $_POST[$field];
				}
			}
			
		}

		return KB_View::template('_form', array('form' => $form));
	}

	public function act() {
		
		$uri = KB_URI::parse();
		
		$this->content = '';
		switch ($uri['action']) {
			case '' 		:
			case 'index' 	:
			case 'list' 	: $this->content = $this->action_list($uri); break;
			case 'add'  	: $this->content = $this->action_add($uri); break;
			case 'edit' 	: $this->content = $this->action_edit($uri); break;
			case 'search' 	: $this->content = $this->action_search($uri); break;
			default 		: KB_Response::instance(null, 404)->send(true);exit();
		}

		if ($this->decorate){
			list($scripts, $styles) = $this->_process_assets();

			$this->content = KB_View::template('_template', array(
				'title' => $this->title, 
				'scripts' => $scripts, 
				'styles' => $styles, 
				'content' => $this->content, 
				'last_entries' => $this->_last_entries(),
			));
		}

		return $this->content;


	}

	protected function _last_entries() {
			
		$entries = KB_Query::instance('"main"."entries"')->select('*', null, 'ORDER BY "id" DESC LIMIT 10');
		return KB_View::template('_last_entries', array('entries' => $entries));
	}

	protected function _process_assets() {
		$scripts = '';
		$styles = '';

		foreach ($this->styles as $k => $style) {
			$params = array('rel' => 'stylesheet', 'type' => 'text/css');
			$stparams = '';
			$new_params = array();

			if (is_string($k)) {
				$url = $k;
				$new_params = $style;
			} else {
				$url = $style;
			}
			$params = array_merge($params, $new_params, array('href' => '/assets/css/'. $url));
			
			foreach ($params as $k => $v) {
				$stparams .= ' '. $k. '="'. $v. '"';
			}
			$styles .= '<link '. $stparams. '/>'. PHP_EOL;
		}

		foreach ($this->scripts as $script) {
			$scripts .= '<script type="text/javascript" src="/assets/js/'. $script. '"></script>'. PHP_EOL;
		}

		return array($styles, $scripts);
	}

}
