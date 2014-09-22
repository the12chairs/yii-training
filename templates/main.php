<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'MusicBand project',
// set languages
    'sourceLanguage' => '%%sourceLang%%',
    'language' => '%%defaultLang%%',
// preloading 'log' component
    'preload'=>array('log'),
// path aliases
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
    ),

    'behaviors' => array(
        array('class' => 'application.extensions.CorsBehavior',
            'route' => array('ApiController/list', 'ApiController/view', ),
            'allowOrigin' => '*.domain.com'
        ),
    ),
// autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
        'bootstrap.behaviors.TbWidget',
    ),
    'modules'=>array(
// uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'%%giiPass%%',
// If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
    ),
// application components
    'components'=>array(
        'user'=>array(
// enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
// bootstrap component
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
// auth manager here
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
// user component
        'user' => array(
            'class' => 'WebUser',
        ),
// uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
                array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
                // Other controllers
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),
// uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=%%dbname%%',
            'emulatePrepare' => true,
            'username' => '%%dbuser%%',
            'password' => '%%dbpassword%%',
            'charset' => 'utf8',
        ),
        'errorHandler'=>array(
// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
// uncomment the following to show log messages on web pages
                /*
                array(
                'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),
// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params'=>array(
// this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);