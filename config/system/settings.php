<?php

return [
    'BE' => [
        'compressionLevel' => 5,
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'lockIP' => '4',
        'lockSSL' => true,
        'loginSecurityLevel' => 'rsa',
        // require MFA for all admins
        'requireMfa' => 3,
        'sessionTimeout' => '36000',
        'versionNumberInFilename' => true,
        'warning_email_addr' => 'example@example.com',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'port' => 3306,
                'driver' => 'mysqli',
                'charset' => 'utf8mb4',
                'tableoptions' => [
                     'charset' => 'utf8mb4',
                     'collate' => 'utf8mb4_unicode_ci',
                ],
            ],
        ],
    ],
    'EXT' => [
        'allowLocalInstall' => false,
    ],
    'EXTENSIONS' => [
        'be_secure_pw' => [
            'passwordLength' => '8',
            'lowercaseChar' => '1',
            'capitalChar' => '1',
            'digit' => '1',
            'specialChar' => '1',
            'patterns' => '3',
            'validUntil' => '',
        ],
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => '',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '0',
            'offlineMode' => '1',
        ],
        'mklog' => [
            'enable_devlog' => '1',
            'exclude_ext_keys' => 'extbase,TYPO3\\CMS\\Sv\\AuthenticationService,TYPO3\\CMS\\Core\\Authentication\\AbstractUserAuthentication',
            'gelf_credentials' => '',
            'gelf_enable' => '1',
            'gelf_min_log_level' => \DMK\Mklog\Utility\SeverityUtility::CRITICAL,
            'gelf_transport' => '',
            'host' => 'www.my-project-webroot.net',
            'max_logs' => '10000',
            'min_log_level' => \DMK\Mklog\Utility\SeverityUtility::WARNING,
        ],
        'mksanitizedparameters' => [
            'debugMode' => '0',
            'logMode' => '1',
            'stealthMode' => '0',
            'stealthModeStoragePid' => '1',
        ],
        'rn_base' => [
            'activateCache' => '0',
            'activateSubstCache' => '0',
            'debugKey' => '',
            'dieOnMayday' => '0',
            'exceptionHandler' => '',
            'forceException4Mayday' => '1',
            'fromEmail' => 'noreply@domain.de',
            'loadHiddenObjects' => '0',
            'send503HeaderOnException' => '1',
            // will be replaced in AdditionalConfiguration.php with $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr']
            'sendEmailOnException' => '',
            'verboseMayday' => '0',
        ],
	    'rsaauth' => [
            'temporaryDirectory' => '',
        ],
        'saltedpasswords' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
            'enableBELog' => '1'
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
            'enableBELog' => '1'
         ],
    ],
    'FE' => [
        'activateContentAdapter' => false,
        'cacheHash' => [
            'enforceValidation' => true,
        ],
        'compressionLevel' => 5,
        'debug' => false,
        'disableNoCacheParameter' => true,
        'lifetime' => '3600',
        'lockIP' => '4',
        'loginSecurityLevel' => 'rsa',
        'pageNotFoundOnCHashError' => true,
    ],
    'GFX' => [
        'jpg_quality' => '80',
        'processor' => 'GraphicsMagick',
        'processor_allowTemporaryMasksAsPng' => false,
        'processor_colorspace' => 'RGB',
        'processor_effects' => false,
        'processor_enabled' => 1,
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'MAIL' => [
        'defaultMailFromAddress' => 'noreply@tld.de',
        'validators' => [
            // more strict than the default \Egulias\EmailValidator\Validation\RFCValidation
            // which allows emails like "Mohnblume880 @gmail.com"
            \Egulias\EmailValidator\Validation\NoRFCWarningsValidation::class,
        ],
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i',
    ],
    'SYS' => [
        'belogErrorReporting' => 0,
        'cookieSecure' => 1,
        'debugExceptionHandler' => \DMK\Mktools\ErrorHandler\ThrowableExceptionHandler::class,
        'devIPmask' => 'XXX.XXX.XXX.XXX',
        'displayErrors' => -1,
        'encryptionKey' => '[the key should be written in the credentials.php]',
        'errorHandler' => \DMK\Mktools\ErrorHandler\ErrorHandler::class,
        // 6135 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED)
        'errorHandlerErrors' => 6135,
        // 5621 = E_ALL & ~(E_STRICT | E_NOTICE | E_DEPRECATED | E_USER_DEPRECATED | E_WARNING | E_USER_WARNING)
        'exceptionalErrors' => 5621,
        'features' => [
            'security.usePasswordPolicyForFrontendUsers' => true,
            'unifiedPageTranslationHandling' => true,
        ],
        'fileCreateMask' => '0660',
        'folderCreateMask' => '2770',
        'productionExceptionHandler' => \DMK\Mktools\ErrorHandler\ThrowableExceptionHandler::class,
        'reverseProxyHeaderMultiValue' => 'first',
        'sitename' => 'DMK TYPO3',
        'systemLocale' => 'de_DE.utf8',
        'UTF8filesystem' => true,
    ],
];
