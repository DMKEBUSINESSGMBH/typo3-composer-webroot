<?php

// $_SERVER['HTTPS'] liefert keine gewuenschte ergebnisse. Deswegen umgehen wir die Variable
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTOCOL']) &&  $_SERVER['HTTP_X_FORWARDED_PROTOCOL'] === 'https') {
	$_SERVER['HTTPS'] = 1;
}


$TYPO3_CONF_VARS['SYS']['productionExceptionHandler'] = 'tx_mktools_util_ExceptionHandler';
$TYPO3_CONF_VARS['SYS']['debugExceptionHandler'] = 'tx_mktools_util_ExceptionHandler';
$TYPO3_CONF_VARS['SYS']['errorHandler'] = 'tx_mktools_util_ErrorHandler';
//Fehler werden schon über enable_errorDLOG und enable_exceptionDLOG geloggt
$TYPO3_CONF_VARS['SYS']['syslogErrorReporting'] = 0;
//Fehler werden schon über enable_errorDLOG und enable_exceptionDLOG geloggt
$TYPO3_CONF_VARS['SYS']['belogErrorReporting'] = 0;
$TYPO3_CONF_VARS['SYS']['enable_errorDLOG'] = '1';
$TYPO3_CONF_VARS['SYS']['enable_exceptionDLOG'] = '1';

//6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
//alles behandeln außer unkritische Meldungen
$TYPO3_CONF_VARS['SYS']['errorHandlerErrors'] = 6135;
//30205 = E_ALL & ~(E_WARNING | E_USER_WARNING)
//damit werden Warnungen geloggt aber im FE wir keine Fehlerseite angezeigt. kritische Fehler werden mit Fehlerseite beendet.
$TYPO3_CONF_VARS['SYS']['exceptionalErrors'] = 30205;
$TYPO3_CONF_VARS['SYS']['displayErrors'] = '2';
$TYPO3_CONF_VARS['SYS']['systemLogLevel'] = '3';
//fatale Fehler werden direkt per Mail gemeldet. Alles ab Fehler läuft ins PHP Error Log zusätzlich zum devlog.
$TYPO3_CONF_VARS['SYS']['systemLog'] = 'mail,wswonline.warnings@dmkdev.de,4;error_log,,3;syslog,LOCAL0,,3';
$TYPO3_CONF_VARS['SYS']['sqlDebug'] = '0';

$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = 0;
$TYPO3_CONF_VARS['SYS']['noEdit'] = 1;
