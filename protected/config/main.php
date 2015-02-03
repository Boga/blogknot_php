<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'My Web Application',

    // preloading 'log' component
    'preload'    => ['log'],

    // autoloading model and component classes
    'import'     => [
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
    ],

    'modules'    => [
        // uncomment the following to enable the Gii tool
//        'gii' => [
//            'class'     => 'system.gii.GiiModule',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters' => ['127.0.0.1', '::0'],
//        ],
    ],

    // application components
    'components' => [

        'user'         => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ],

        'urlManager'   => [
            'urlFormat'      => 'path',
            'showScriptName' => false,
            'rules'          => [
                'api/<controller:\w+>'                   => '<controller>/ajax',
                'api/<controller:\w+>/<id:\d+>'          => '<controller>/ajax',

                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',

            ],
        ],

        // database settings are configured in database.php
        'db'           => require(dirname(__FILE__) . '/database.php'),

        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ],

        'clientScript' => [
            'defaultScriptFilePosition' => CClientScript::POS_END,
            'packages'                  => [
                'notes'   => [
//                    'basePath'=> implode(DIRECTORY_SEPARATOR, [DIR_ROOT, 'public', 'js']),
//                    'basePath'=> '/public',
                    'baseUrl' => '',
                    'js'      => [
                        'js/node_modules/angular/angular.js',
                        'js/node_modules/angular-route/angular-route.js',
                        'js/controllers.js',
                        'js/app.js',
                        'js/phones.json'
                    ],
                    'css'     => ['css/note.css'],
                    'depends' => ['jquery'],
                ],
            ],
        ],

        'log'          => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ],
        ],

    ],

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'     => [
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ],
];
