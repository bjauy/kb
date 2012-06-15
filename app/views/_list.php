<div class="content">
<?php

if (!empty($entries)) {
	echo '<ul id="entries">';
	
	foreach ($entries as $entry) {
		echo '<li><h2 title="'. $entry->name. '"><a href="/edit/id/'. $entry->id. '">'. $entry->name. '</a><span class="tags">'. KB_Text::tags($entry->tags). '</span></h2><div>'. $entry->body. '</p></li>';
	}
	
	echo '</ul>';
}
?></div>
