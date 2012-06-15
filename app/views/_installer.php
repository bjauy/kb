<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Install</title>
<link rel="stylesheet/less" type="text/css" href="/assets/css/style.less" media="screen"/>
<script type="text/javascript" src="/assets/js/less-1.3.0.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/assets/js/installer.js"></script>
</head>
<body>
<h1>Requirements</h1>
<ul>
<?php 

$install = true;
foreach ($requirements as $id => $req) {
	echo '<li>'. $id. ' => '. $req. '</li>';

	if (!$req) {
		$install = false;
	}

} 

?></ul>
<div id="install_messages">
<?php
if (!$install) {
	echo '<h4 class="message error">Fix errors above before you continue</h4>';

} else {
	echo '<p><button type="button" class="button" id="install">Prepare KB</button></p>';

}
?></div>
</body>
</html>

