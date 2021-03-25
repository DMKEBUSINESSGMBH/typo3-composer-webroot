<?php
call_user_func(
    function () use (&$warningMail) {
        // skip ssl redirect on dev enviroment
        $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '0';

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] .= ',127.0.0.1';

        //30711 = E_ALL & ~(E_STRICT | E_NOTICE)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 30711;
        //alles als Exception behandeln (Fehlerseite ausgeben, Logging)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'];
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = 'file';

        $GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter'] = false;

        $GLOBALS['TYPO3_CONF_VARS']['MAIL'] = array_merge(
            $GLOBALS['TYPO3_CONF_VARS']['MAIL'],
            array(
                'transport' => 'smtp',
                'transport_smtp_server' => 'mailhog:1025',
                'defaultMailFromAddress' => $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'],
                'defaultMailFromName' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
            )
        );

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['min_log_level'] = \DMK\Mklog\Utility\SeverityUtility::DEBUG;
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['gelf_enable'] = 0;
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['max_logs'] = 1000000;

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['rn_base']['verboseMayday'] = 1;
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['rn_base']['dieOnMayday'] = 1;

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mksanitizedparameters']['debugMode'] = 1;
        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mksanitizedparameters']['logMode'] = 1;

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['extensionmanager']['offlineMode'] = 0;

        $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 1;
    }
);
