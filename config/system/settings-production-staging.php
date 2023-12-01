<?php
call_user_func(
    function () use (&$warningMail) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['min_log_level'] = \DMK\Mklog\Utility\SeverityUtility::INFO;
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['host'] = 'stage.my-project-webroot.net';
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['gelf_enable'] = 0;

        //6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 6135;//alles behandeln außer unkritische Meldungen
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'];//alles als Exception behandeln (Fehlerseite ausgeben, Logging)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
    }
);

