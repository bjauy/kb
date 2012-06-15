<?php

if (!empty($results)) {

	$ret = array();
	foreach ($results as $search_entry) {

		$ret[] = array('link' => '/edit/id/'. $search_entry->id,
			'name' => KB_Text::mark($search_entry->name, $query),
			'body' => KB_Text::mark(KB_Text::strip($search_entry->body), $query),
			'tags' => KB_Text::mark($search_entry->tags, $query),
			);			
		
	}
	KB_Response::instance(json_encode($ret), 200, array('Content-Type: text/javascript'))->send(true);

}

