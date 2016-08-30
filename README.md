# DMK TYPO3 Composer Webroot Project

Creates a filebased [TYPO3](http://typo3.org/) installation
with [Composers](https://getcomposer.org/).


## Usage

### Project Creation

Create a new TYPO3 Project using Composer

    $ composer create-project dmk/typo3-composer-webroot my-project-webroot dev-htdocs76

This creates the required Folders for TYPO3,
for example the fileadmin, typo3conf, etc.

The installation process should look like this:

    Installing dmk/typo3-composer-webroot (0.1.0)
      - Installing dmk/typo3-composer-webroot (0.1.0)
        Cloning 60b8ad8f1670b52033ea6356a70fc73882bdc8f6

    Created project in my-project-webroot
    Loading composer repositories with package information
    Installing dependencies (including require-dev)
      - Installing typo3/cms-composer-installers (dev-master a6558e3)
        Cloning a6558e3521071b6051a9fbd5beccfdbe10e67aea

      - Installing helhum/class-alias-loader (dev-master 22d49a5)
        Cloning 22d49a54af4d3dc81b7b200355b0d2e67b826ad0

      - Installing typo3/cms (6.2.13)
        Cloning f695f377f48c23bec3156c6d0f58f8a078d8a651

      - Installing typo3-ter/be-secure-pw (6.2.0)
        Downloading: 100%

      - Installing typo3-ter/devlog (2.11.4)
        Downloading: 100%

    Writing lock file
    Generating autoload files
    Generating class alias map files

Then you'll be asked if you want to remove the GIT history.
This we should do!

    Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]? Y

Now we should initialize a new repo

    $ git init

do the initial commit

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

    composer require typo3-ter/static-info-tables:~6.2@stable

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
On every deployment you should copy the file .htaccess_typo3_install to the folder typo3/sysext/install/Start. Before that you should define the IPs which can access the install tool.

Replace every occurence of example@example.com by a suitable email address that should receive mails when errors occur. The same goes for noreply@domain.de

Let the install tool generate a new encryption key.

Use .htaccess_live as .htaccess file for your environments. Before that you should replace ###PUT_HOMEPAGE_HERE### inside the htaccess file with the domain of the environment. Afterwards adjust the DMK_APP_ENV environment variable for your desired environment. This way the configuration for this envirnoment will be loaded automatically. Possible is ALPHA, BETA and LOCAL. Everything else means production. Feel free to extend that.

Create the file typo3conf/Credentials.php in each environment manually which should contain the credentials for connecting to the database or other sensitive credentials like passwords for webservices. Inside add the variable $isLocal = TRUE;, $isAlpha = TRUE; oder $isBeta = TRUE; depending on your enviroment.
