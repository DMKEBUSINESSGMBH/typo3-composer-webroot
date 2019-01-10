<?php
call_user_func(
    function () use (&$warningMail) {
        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mklog']);
        $extConfig['min_log_level'] = \DMK\Mklog\Utility\SeverityUtility::INFO;
        $extConfig['max_logs'] = 1000000;
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mklog'] = serialize($extConfig);

        //6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 6135;//alles behandeln außer unkritische Meldungen
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'];//alles als Exception behandeln (Fehlerseite ausgeben, Logging)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'] = 'mail,%1$s,4;error_log,,2;syslog,LOCAL0,,3';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '0';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
    }
);

