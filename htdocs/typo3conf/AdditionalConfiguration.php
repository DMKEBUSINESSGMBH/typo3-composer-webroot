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

        $applicationContext = \TYPO3\CMS\Core\Core\Environment::getContext();

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
        if (!$applicationContext->isProduction() || $applicationContext->getParent()) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] .= ' [' . (string) $applicationContext . ']';
        }

        $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'] = $warningMail;

        $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['rn_base']['sendEmailOnException'] = $warningMail;

        // we're using mklog as log writer, so we don't need the file log.
        unset($GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING][\TYPO3\CMS\Core\Log\Writer\FileWriter::class]);

        if (!empty($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['enable_devlog'])) {
            $minLogLevel = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['min_log_level']
                ?: \DMK\Mklog\Utility\SeverityUtility::DEBUG;
            $minLogLevel = \DMK\Mklog\Utility\SeverityUtility::getPsrLevelConstant($minLogLevel);
            $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][$minLogLevel][\DMK\Mklog\Logger\DevlogLogger::class] = [];
        }
        if (!empty($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['gelf_enable'])) {
            $minLogLevel = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['mklog']['gelf_min_log_level']
                ?: \DMK\Mklog\Utility\SeverityUtility::ALERT;
            $minLogLevel = \DMK\Mklog\Utility\SeverityUtility::getPsrLevelConstant($minLogLevel);
            $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][$minLogLevel][\DMK\Mklog\Logger\GelfLogger::class] = [];
        }
    }
);
