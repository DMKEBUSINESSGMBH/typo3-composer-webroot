<?php

global $TYPO3_CONF_VARS;

// skip ssl redirect on dev enviroment
$TYPO3_CONF_VARS['BE']['lockSSL'] = '0';

// wenn ein Jenkins Build laeuft, dann wird auch der Cache geleert/Tests ausgefuehrt.
// In diesem Fall wird das alles durch tomcat ausgefuehrt womit neue Ordner auch mit tomcat
// als Nutzer angelegt werden. Dadurch hat dann der normale TYPO3 Nutzer difu keine
// Rechte die Dateien zu entfernen oder neue zu schreiben. Daher muessen wir die Dateimasken
// anpassen damit beide Nutzer Dateien anlegen/entfernen duerfen
$TYPO3_CONF_VARS['BE']['fileCreateMask'] = '0775';
$TYPO3_CONF_VARS['BE']['folderCreateMask'] = '0775';

//30711 = E_ALL & ~(E_STRICT | E_NOTICE)
$TYPO3_CONF_VARS['SYS']['errorHandlerErrors'] = 30711;
//alles als Exception behandeln (Fehlerseite ausgeben, Logging)
$TYPO3_CONF_VARS['SYS']['exceptionalErrors'] = $TYPO3_CONF_VARS['SYS']['errorHandlerErrors'];
$TYPO3_CONF_VARS['SYS']['displayErrors'] = '1';
$TYPO3_CONF_VARS['SYS']['systemLogLevel'] = '0';
//fatale Fehler werden direkt per Mail gemeldet. Alles ab Warnung läuft ins PHP Error Log zusätzlich zum devlog.
$TYPO3_CONF_VARS['SYS']['systemLog'] = 'mail,%2$s,4;error_log,,2;syslog,LOCAL0,,3';
$TYPO3_CONF_VARS['SYS']['sqlDebug'] = '1';
$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = 'file';

$TYPO3_CONF_VARS['EXT']['extConf']['mksanitizedparameters'] = 'a:4:{s:11:"stealthMode";s:1:"0";s:21:"stealthModeStoragePid";s:1:"1";s:9:"debugMode";s:1:"1";s:7:"logMode";s:1:"1";}';
$TYPO3_CONF_VARS['EXT']['extConf']['rn_base'] = 'a:11:{s:13:"verboseMayday";s:1:"1";s:11:"dieOnMayday";s:1:"1";s:21:"forceException4Mayday";s:1:"1";s:16:"exceptionHandler";s:27:"tx_rnbase_exception_Handler";s:20:"sendEmailOnException";s:%1$d:"%2$s";s:9:"fromEmail";s:17:"noreply@domain.de";s:24:"send503HeaderOnException";s:1:"1";s:17:"loadHiddenObjects";s:1:"0";s:13:"activateCache";s:1:"0";s:18:"activateSubstCache";s:1:"0";s:8:"debugKey";s:9:"dmkhp2014";}';
$TYPO3_CONF_VARS['EXT']['extConf']['extensionmanager'] = 'a:2:{s:21:"automaticInstallation";s:1:"0";s:11:"offlineMode";s:1:"0";}';
