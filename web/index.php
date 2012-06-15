<?php
error_reporting(-1);
define ('KBROOT', dirname(dirname(__FILE__)));
define ('KBDATA', KBROOT. DIRECTORY_SEPARATOR. 'data');
define ('KBAPP', KBROOT. DIRECTORY_SEPARATOR. 'app');
define ('KBWEB', KBROOT. DIRECTORY_SEPARATOR. 'web');

if (!file_exists(KBDATA. DIRECTORY_SEPARATOR. '.installed')) {
	require_once(KBWEB. DIRECTORY_SEPARATOR. 'install.php');
	exit();
}

require_once(KBAPP. DIRECTORY_SEPARATOR. 'app.php');

