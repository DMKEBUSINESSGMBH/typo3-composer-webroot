<?php

global $TYPO3_CONF_VARS;

// skip ssl redirect on beta enviroment
$TYPO3_CONF_VARS['BE']['lockSSL'] = '0';

//6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
//alles behandeln außer unkritische Meldungen
$TYPO3_CONF_VARS['SYS']['errorHandlerErrors'] = 6135;
$TYPO3_CONF_VARS['SYS']['exceptionalErrors'] = $TYPO3_CONF_VARS['SYS']['errorHandlerErrors'];
//alles als Exception behandeln (Fehlerseite ausgeben, Logging)
$TYPO3_CONF_VARS['SYS']['displayErrors'] = '1';
$TYPO3_CONF_VARS['SYS']['systemLogLevel'] = '0';
$TYPO3_CONF_VARS['SYS']['sqlDebug'] = '1';
$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = 'file';


$TYPO3_CONF_VARS['SYS']['systemLog'] = 'mail,%2$s,4;error_log,,2;syslog,LOCAL0,,3';
$TYPO3_CONF_VARS['EXT']['extConf']['rn_base'] = 'a:11:{s:13:"verboseMayday";s:1:"1";s:11:"dieOnMayday";s:1:"1";s:21:"forceException4Mayday";s:1:"1";s:16:"exceptionHandler";s:27:"tx_rnbase_exception_Handler";s:20:"sendEmailOnException";s:%1$d:"%2$s";s:9:"fromEmail";s:17:"noreply@domain.de";s:24:"send503HeaderOnException";s:1:"1";s:17:"loadHiddenObjects";s:1:"0";s:13:"activateCache";s:1:"0";s:18:"activateSubstCache";s:1:"0";s:8:"debugKey";s:9:"dmkhp2014";}';
