<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<?php echo $scripts; ?>
<?php echo $styles; ?>
</head>
<body>
<div id="list">
<a href="/add" id="add_new"><?php echo __('Add new entry', 'form'); ?></a>
<form action="/search" method="post" id="search_form">
<label for="query"><?php echo __('Search'); ?></label>
<input type="search" placeholder="<?php echo __('Search'). '...'; ?>" name="query" id="query"/>
</form>
<h4><?php echo __('Last entries', 'form'); ?></h4>
<?php echo $last_entries; ?>
<a href="/" id="show_all"><?php echo __('Show all'); ?></a>
</div>
<?php echo $content; ?>
</body>
</html>
