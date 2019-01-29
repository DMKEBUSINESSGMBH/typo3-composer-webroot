<?php
call_user_func(
    function () use (&$warningMail) {
        // skip ssl redirect on dev enviroment
        $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '0';

        //30711 = E_ALL & ~(E_STRICT | E_NOTICE)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 30711;
        //alles als Exception behandeln (Fehlerseite ausgeben, Logging)
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'];
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '0';
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

        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mklog']);
        $extConfig['min_log_level'] = \DMK\Mklog\Utility\SeverityUtility::DEBUG;
        $extConfig['gelf_enable'] = 0;
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

        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['extensionmanager']);
        $extConfig['offlineMode'] = 0;
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['extensionmanager'] = serialize($extConfig);
        
        $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 1;
    }
);
