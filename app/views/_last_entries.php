<?php

if (!empty($entries)) {
	echo '<ul id="last_entries">';
	
	foreach ($entries as $entry) {
		echo '<li><h6 title="'. $entry->name. '"><a href="/edit/id/'. $entry->id. '">'. KB_Text::shorten($entry->name, 30, '...'). '</a><span class="tags">'. KB_Text::tags($entry->tags). '</span></h6><p>'. KB_Text::shorten(KB_Text::strip($entry->body), 100, '...'). '</p></li>';
	}
	
	echo '</ul>';
}
