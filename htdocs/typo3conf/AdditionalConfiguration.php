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

        $bootstrap = \TYPO3\CMS\Core\Core\Bootstrap::getInstance();
        $applicationContext = $bootstrap->getApplicationContext();

        // can be used in the conf files
        $warningMail = $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'];

        // Load Config Files
        // having a parent context means we are in a subcontext like Production/Staging
        // and not just Production etc.
        $environmentConfigurationKey = $applicationContext->getParent() !== null ?
            str_replace('/', '', (string) $applicationContext) :
            (string) $applicationContext;
        foreach (array(
            'Credentials',
            'Configuration' . $environmentConfigurationKey,
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
