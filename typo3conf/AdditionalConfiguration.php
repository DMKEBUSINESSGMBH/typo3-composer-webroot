<?php

defined('TYPO3_MODE') || die('Access denied.');

// check Credentials
is_readable(dirname(__FILE__).'/Credentials.php')
	|| exit('FATAL ERROR: Credentials missed for TYPO3 configuration!');

// Load Config Files
foreach (
	array(
		'Credentials',
		'ConfigurationLive',
		'ConfigurationBeta',
		'ConfigurationDev',
		'ConfigurationLocal',
		'Credentials',
	) as $confFile
) {
	$confFile = dirname(__FILE__) . '/' . $confFile . '.php';
	if (is_readable($confFile)) {
		require_once $confFile;
	}
}
unset($confFile);
