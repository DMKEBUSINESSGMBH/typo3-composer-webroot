<?php
call_user_func(
    function () use (&$warningMail) {
        // skip ssl redirect on beta enviroment
        $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '0';

        //6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
        //alles behandeln außer unkritische Meldungen
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 6135;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'];
        //alles als Exception behandeln (Fehlerseite ausgeben, Logging)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '0';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';

        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mklog']);
        $extConfig['min_log_level'] = \DMK\Mklog\Utility\SeverityUtility::DEBUG;
        $extConfig['max_logs'] = 1000000;
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mklog'] = serialize($extConfig);

        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['rn_base']);
        $extConfig['verboseMayday'] = 1;
        $extConfig['dieOnMayday'] = 1;
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['rn_base'] = serialize($extConfig);

        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mksanitizedparameters']);
        $extConfig['debugMode'] = 1;
        $extConfig['logMode'] = 1;
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mksanitizedparameters'] = serialize($extConfig);
    }
);
