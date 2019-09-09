# DMK TYPO3 Composer Webroot Project

Creates a filebased [TYPO3](http://typo3.org/) installation
with [Composers](https://getcomposer.org/).


## Usage

### Project Creation

Create a new TYPO3 Project using Composer

    $ composer create-project dmk/typo3-composer-webroot my-project-webroot dev-typo3-95

This creates the required Folders for TYPO3,
for example the fileadmin, typo3conf, etc.

The installation process should look like this:

    Installing dmk/typo3-composer-webroot (dev-typo3-95)
    - Installing dmk/typo3-composer-webroot (dev-typo3-95 typo3-95)


    Created project in my-project-webroot
    Loading composer repositories with package information
    Installing dependencies (including require-dev)
      - Installing typo3/cms-composer-installers (dev-master)

      - Installing typo3/cms (9.5)

    Writing lock file
    Generating autoload files
    Generating class alias map files

Then you'll be asked if you want to remove the GIT history.
This we should do!

    Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]? Y

Now we should initialize a new repo

    $ git init

After the customization is done (see below), we do the initial commit

    $ git add --all
    $ git commit -m "initial commit"

add the new project remote

    $ git remote add origin [PATH_TO_PROJECT_REPOSITORY]

and push the project to the repo

    $ git push --set-upstream origin master

### Specific DocRoot

In a lot of cases it will be usefull to define a DocRoot for the projekt.
So the public files will be stored there and all other, like vendor, are outside.

This feature is new in the CmsComposerInstaller since 1.2.2. and enabled by default.

### Add Extensions

To install an extension from the [TER](https://typo3.org/extensions/repository/),
for example static_info_tables, you can simply perform the following command:

    composer require typo3-ter/static-info-tables:~7.6@stable

Pay attention to replace underscores "_" by a dash "-" in the extension key.


To append an extension from a own repository,
you has to add the repository to the composer.json first.
To add the powerful MKSEACRH extension you has to perform the following command:

    $ composer config repositories.mksearch vcs https://github.com/DMKEBUSINESSGMBH/typo3-mksearch.git

Be sure, that there is an composer.json in the repository like this one:

    {
        "name" : "dmk/mksearch",
        "type" : "typo3-cms-extension",
        "keywords" : ["TYPO3 CMS", "search", "Lucene", "Zend Lucene", "Apache Solr", "Solr", "Elasticsearch"],
        "homepage" : "http://www.dmk-ebusiness.de/",
        "license" : "GPL-2.0+",
        "replace": {
            "typo3-ter/mksearch": "*"
        }
    }

Now you can install the Extension with the require command:

    composer require dmk/mksearch:dev-master

Finally install the extension with the TYPO3 Extension Manager in the TYPO3 Backend
add the composer.json, composer.lock, typo3conf/LocalConfiguration.php, typo3conf/PackageStates.php
to the git and commit and push the changes.

### Customization

  * Replace the `warning_email_addr` `example@example.com` in the `BE` Section in the LocalConfiguration.php.
      * don't forget to create the adress
      * best practise is to have a mailing list where everyone is added who is involved in the project
  * Replace `fromEmail` `noreply@domain.de` in the extension configuration for rn_base.
  * Replace $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] `noreply@tld.de` in the LocalConfiguration.php.
  * Replace $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = 'XXX.XXX.XXX.XXX' in the LocalConfiguration.php. 
  * Replace `XXX.XXX.XXX.XXX` in the `.htaccess*` files with the IP that can access the System in maintenance mode.
  * Use .htaccess_* as .htaccess file for your environments. If needed add authentication
  * Create `htdocs/typo3conf/Credentials.php` with all the security critical data like database credentials.  
    A example is given in Credentials.php.inst in the repo root.
  * Create an encryption key and insert the key in the Credentials.php (don't store security critical data in git).
  * Optionaly enable some improvements in the extension configuration of MKTOOLS.
  * install gridelements or a similar extension
  * install static_info_tables if needed. The current version 6.4.3 is buggy as the static import fails as soon as a extension is installed, that enhances the static_countries database table (@see https://forge.typo3.org/issues/82132) like mklib does. As a workaround uninstall mklib temporarily for inserting the static data of static_info_tables.
  * set up scheduler tasks for mklog DevLog WatchDog (recommended: check for errors and above every 5 minutes, check for notices and above two times a day)
  * set up scheduler tasks for maintenance like mklib tasks for detecting failed and frozen tasks, anonymize IPs in the database, garbage collection for tables and caching framework
  * set up monitoring with caretaker_instance extension
  * adjust content of fehler.html (used as ErrorDocument for 5xx errors and in case of pageUnavailable handling of TYPO3)
  * provide the following pages in TYPO3: 404.html (used as ErrorDocument in htaccess and as 404 page for default page not found handling) and /fehler (used in htaccess as ErrorDocuments)
  * When Let's Encrypt is used, switch the deny RewriteRule for the well-known folder in .htaccess
  * copy .htaccess_typo3 to your typo3 folder to have access restriction for the install tool (you need to configure the IPs that are whitelisted, htpasswd etc. as you like inside the htaccess file)
  * Do not forget to set the application context for the CLI. This includes setting it for the scheduler cron command: `TYPO3_CONTEXT="Production/Staging" ! test -e $pathToHtdocs/MAINTENACE_MODE && $pathToHtdocs/typo3/sysext/core/bin/typo3 scheduler:run`. Addtionally you need to set it globally like descriped [here](https://unix.stackexchange.com/questions/21598/how-do-i-set-a-user-environment-variable-permanently-not-session). Both is required to have the correct context in any case.
      * the context in the WEB is set through the .htaccess file of the environment
      * default is Production. So you normally only have to set the context on CLI in Production/Staging environment. All other environments should be fine.
  * when the site is hosted on a Mittwald server it might be necessary to remove $GLOBALS['TYPO3_CONF_VARS']['BE']['fileCreateMask'] and $GLOBALS['TYPO3_CONF_VARS']['BE']['folderCreateMask'] from LocalConfiguration.php and use the default values.
  * think about using Redis as caching backend


