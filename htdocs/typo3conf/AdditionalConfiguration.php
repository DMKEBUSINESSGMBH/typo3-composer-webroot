<?php

defined('TYPO3_MODE') || die('Access denied.');

// check Credentials
if (!is_readable(dirname(__FILE__) . '/Credentials.php')) {
    exit(
        'FATAL ERROR: Credentials missed for TYPO3 configuration! <br />Please add Credentials.php in ' .
        dirname(__FILE__) . ' based on ' . dirname(__FILE__) . '/Credentials.php.dist'
    );
}

call_user_func(
    function () {
        // support SSL when behind a proxy
        if (!empty($_SERVER['HTTP_X_FORWARDED_PROTOCOL']) && $_SERVER['HTTP_X_FORWARDED_PROTOCOL'] === 'https') {
            $_SERVER['HTTPS'] = 1;
        }

        $applicationContext = \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext();

        // can be used in the conf files
        $warningMail = $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'];

        // Load Config Files
        foreach (array(
            'Credentials',
            $applicationContext->isProduction() ? 'ConfigurationProduction' : '',
            $applicationContext->isTesting() ? 'ConfigurationTesting' : '',
            $applicationContext->isDevelopment() ? 'ConfigurationDevelopment' : '',
            // includes for example "ConfigurationProductionStaging"
            // if a parent context was set like TYPO3_CONTEXT="Production/Staging"
            $applicationContext->getParent() !== null ? 'Configuration' . str_replace('/', '', (string) $applicationContext) : '',
            'Credentials',
        ) as $confFile) {
            $confFile = empty($confFile) ? false : dirname(__FILE__) . '/' . $confFile . '.php';
            if ($confFile && is_readable($confFile)) {
                require $confFile;
            }
        }

        // set the sitename, depending on TYPO3_CONTEXT
        if (!$applicationContext->isProduction()) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] .= ' [' . (string) $applicationContext . ']';
        }

        $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'] = $warningMail;

        // remplate the warning mail in configs
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'] = sprintf(
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'],
            $warningMail
        );

        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['rn_base'] = sprintf(
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['rn_base'],
            strlen($warningMail),
            $warningMail
        );

        // we're using mklog as log writer, so we don't need the file log.
        unset($GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING]['TYPO3\\CMS\\Core\\Log\\Writer\\FileWriter']);
    }
);
