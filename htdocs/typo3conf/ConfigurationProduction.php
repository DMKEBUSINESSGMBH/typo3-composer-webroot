<?php

global $TYPO3_CONF_VARS;

// skip ssl redirect on dev enviroment
$TYPO3_CONF_VARS['BE']['lockSSL'] = 2;


//fatale Fehler werden direkt per Mail gemeldet. Alles ab Warnung läuft ins PHP Error Log zusätzlich zum devlog.
$TYPO3_CONF_VARS['SYS']['systemLog'] = 'mail,%2$s,4;error_log,,2;syslog,LOCAL0,,3';
