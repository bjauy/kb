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
			<h4><?php echo __('Last entries', 'form'); ?></h4>
			<?php echo $last_entries; ?>
		</div>
		<?php echo $content; ?>
		<footer id="footer">
			<ul>
				<li>
					<a href="/"><?php echo __('List', 'form'); ?></a>
				</li>
				<li>
					<a href="/add"><?php echo __('Add new', 'form'); ?></a>
				</li>
				<li id="search">
					<form action="/search" method="post" id="search_form">					
						<input type="search" placeholder="<?php echo __('Search...', 'form'); ?>" name="query" id="query"/>
						<ul id="search_results"></ul>
					</form>
				</li>
			</ul>
		</footer>
	</body>
</html>
