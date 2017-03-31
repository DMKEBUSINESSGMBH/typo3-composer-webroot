<?php

defined('TYPO3_MODE') || die('Access denied.');

// $_SERVER['HTTPS'] liefert keine gewuenschte ergebnisse. Deswegen umgehen wir die Variable
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTOCOL']) &&  $_SERVER['HTTP_X_FORWARDED_PROTOCOL'] === 'https') {
	$_SERVER['HTTPS'] = 1;
}

// check Credentials
is_readable(dirname(__FILE__).'/Credentials.php')
	|| exit('FATAL ERROR: Credentials missed for TYPO3 configuration!');

call_user_func(
	function () {
		global $TYPO3_CONF_VARS;

		$bootstrap = \TYPO3\CMS\Core\Core\Bootstrap::getInstance();
		$applicationContext = $bootstrap->getApplicationContext();

		// can be used in the conf files
		$warningMail = $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'];

		// Load Config Files
		foreach (
			array(
				'Credentials',
				$applicationContext->isProduction() ? 'ConfigurationProduction' : '',
				$applicationContext->isTesting() ? 'ConfigurationTesting' : '',
				$applicationContext->isDevelopment() ? 'ConfigurationDevelopment' : '',
				'Credentials',
			) as $confFile
		) {
			$confFile = empty($confFile) ? false : dirname(__FILE__) . '/' . $confFile . '.php';
			if ($confFile && is_readable($confFile)) {
				require $confFile;
			}
		}

		// set the sitename, depending on TYPO3_CONTEXT
		if (!$applicationContext->isProduction()) {
			$TYPO3_CONF_VARS['SYS']['sitename'] .= ' [' . (string) $applicationContext . ']';
		}

		$TYPO3_CONF_VARS['BE']['warning_email_addr'] = $warningMail;

		// remplate the warning mail in configs
		$TYPO3_CONF_VARS['SYS']['systemLog'] = sprintf(
			$TYPO3_CONF_VARS['SYS']['systemLog'],
			'',
			$warningMail
		);
		$TYPO3_CONF_VARS['EXT']['extConf']['rn_base'] = sprintf(
			$TYPO3_CONF_VARS['EXT']['extConf']['rn_base'],
			strlen($warningMail),
			$warningMail
		);
	}
);
