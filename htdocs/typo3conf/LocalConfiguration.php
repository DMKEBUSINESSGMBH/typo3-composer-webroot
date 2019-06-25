<?php

return [
    'BE' => [
        'compressionLevel' => 5,
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'lockIP' => '4',
        'lockSSL' => true,
        'loginSecurityLevel' => 'rsa',
        'sessionTimeout' => '36000',
        'versionNumberInFilename' => true,
        'warning_email_addr' => 'example@example.com',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'driver' => 'mysqli',
                'port' => 3306,
            ],
        ],
    ],
    'EXT' => [
        'allowLocalInstall' => '0',
        'extConf' => [
            'be_secure_pw' => 'a:7:{s:14:"passwordLength";s:1:"8";s:13:"lowercaseChar";s:1:"1";s:11:"capitalChar";s:1:"1";s:5:"digit";s:1:"1";s:11:"specialChar";s:1:"1";s:8:"patterns";s:1:"3";s:10:"validUntil";s:0:"";}',
            'extensionmanager' => 'a:2:{s:21:"automaticInstallation";s:1:"0";s:11:"offlineMode";s:1:"1";}',
            'filemetadata' => 'a:0:{}',
            'gridelements' => 'a:2:{s:20:"additionalStylesheet";s:0:"";s:19:"nestingInListModule";s:1:"1";}',
            'mklib' => 'a:7:{s:13:"proxyBeUserId";s:1:"0";s:18:"picturesUploadPath";s:25:"uploads/tx_mklib/pictures";s:12:"portalPageId";s:1:"0";s:12:"logDbHandler";s:1:"0";s:17:"logDbIgnoreTables";s:0:"";s:17:"specialCharMarker";s:12:"SPECIALCHAR_";s:13:"tableWordlist";s:1:"0";}',
            'mklog' => 'a:7:{s:13:"enable_devlog";s:1:"1";s:13:"min_log_level";s:1:"5";s:16:"exclude_ext_keys";s:99:"extbase,TYPO3\\CMS\\Sv\\AuthenticationService,TYPO3\\CMS\\Core\\Authentication\\AbstractUserAuthentication";s:8:"max_logs";s:5:"10000";s:11:"gelf_enable";s:1:"1";s:16:"gelf_credentials";s:0:"";s:18:"gelf_min_log_level";s:1:"1";}',
            'mkphpids' => 'a:0:{}',
            'mksanitizedparameters' => 'a:4:{s:11:"stealthMode";s:1:"0";s:21:"stealthModeStoragePid";s:1:"1";s:9:"debugMode";s:1:"0";s:7:"logMode";s:1:"1";}',
            'mktools' => 'a:13:{s:20:"contentReplaceActive";s:1:"0";s:25:"ajaxContentRendererActive";s:1:"0";s:20:"pageNotFoundHandling";s:1:"0";s:13:"realUrlXclass";s:1:"0";s:22:"seoRobotsMetaTagActive";s:1:"0";s:32:"shouldFalImagesBeAddedToCalEvent";s:1:"0";s:30:"shouldFalImagesBeAddedToTtNews";s:1:"0";s:13:"exceptionPage";s:0:"";s:22:"tableFixedPostVarTypes";s:1:"0";s:24:"realUrlConfigurationFile";s:0:"";s:28:"realUrlConfigurationTemplate";s:0:"";s:27:"tcaPostProcessingExtensions";s:7:"mktools";s:22:"systemLogLockThreshold";s:2:"60";}',
            'phpunit' => 'a:6:{s:17:"excludeextensions";s:8:"lib, div";s:12:"composerpath";s:0:"";s:13:"selenium_host";s:9:"localhost";s:13:"selenium_port";s:4:"4444";s:16:"selenium_browser";s:8:"*firefox";s:19:"selenium_browserurl";s:0:"";}',
            'realurl' => 'a:5:{s:10:"configFile";s:0:"";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}',
            'rn_base' => 'a:11:{s:13:"verboseMayday";s:1:"0";s:11:"dieOnMayday";s:1:"0";s:21:"forceException4Mayday";s:1:"1";s:16:"exceptionHandler";s:0:"";s:20:"sendEmailOnException";s:%1$d:"%2$s";s:9:"fromEmail";s:17:"noreply@domain.de";s:24:"send503HeaderOnException";s:1:"1";s:17:"loadHiddenObjects";s:1:"0";s:13:"activateCache";s:1:"0";s:18:"activateSubstCache";s:1:"0";s:8:"debugKey";s:0:"";}',
            'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
            'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
            'scheduler' => 'a:4:{s:11:"maxLifetime";s:4:"1440";s:11:"enableBELog";s:1:"1";s:15:"showSampleTasks";s:1:"1";s:11:"useAtdaemon";s:1:"0";}',
            'static_info_tables' => 'a:1:{s:13:"enableManager";s:1:"0";}',
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => '',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
	'rsaauth' => [
            'temporaryDirectory' => '',
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
         ],
    ],
    'FE' => [
        'activateContentAdapter' => false,
        'compressionLevel' => 5,
        'debug' => false,
        'disableNoCacheParameter' => true,
        'lifetime' => '3600',
        'lockIP' => '4',
        'loginSecurityLevel' => 'rsa',
        'noPHPscriptInclude' => true,
        'noPHPscriptInclude ' => '1',
        'pageNotFoundOnCHashError' => true,
        'pageNotFound_handling' => '/404/',
        'pageNotFound_handling_statheader' => 'HTTP/1.1 404 Not Found',
        'pageUnavailable_handling' => 'fehler.html',
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
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i',
    ],
    'SYS' => [
        'UTF8filesystem' => '1',
        'belogErrorReporting' => 0,
        'compat_version' => '8.7',
        'debugExceptionHandler' => 'tx_mktools_util_ExceptionHandler',
        'devIPmask' => 'XXX.XXX.XXX.XXX',
        'displayErrors' => -1,
        'encryptionKey' => '[the key should be written in the credentials.php]',
        'errorHandler' => 'tx_mktools_util_ErrorHandler',
	// 6135 = E_ALL & ~( E_STRICT | E_NOTICE |  E_USER_DEPRECATED| E_DEPRECATED)
        'errorHandlerErrors' => 6135,
        // 13821 = E_ALL & ~(E_WARNING | E_STRICT | E_USER_WARNING | E_USER_DEPRECATED)
        'exceptionalErrors' => 13821,
        'fileCreateMask' => '0660',
        'folderCreateMask' => '2770',
        'productionExceptionHandler' => 'tx_mktools_util_ExceptionHandler',
        'reverseProxyHeaderMultiValue' => 'first',
        'sitename' => 'DMK TYPO3',
        'systemLocale' => 'de_DE.utf8',
        'systemLog' => 'mail,%1$s,4;error_log,,2;syslog,LOCAL0,,3',
        'systemLogLevel' => 3,
        'useCachingFramework' => 1,
    ],
];
