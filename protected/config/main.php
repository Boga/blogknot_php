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
            'coreScriptPosition'        => CClientScript::POS_END,
            'defaultScriptPosition'     => CClientScript::POS_END,
            'defaultScriptFilePosition' => CClientScript::POS_END,
            'packages'                  => [
                'notes_reactjs' => [
                    'baseUrl' => '',
                    'js'      => [
                        "js/node_modules/react/dist/react.js",
                        "js/node_modules/jquery/dist/jquery.js",
                        "js/node_modules/showdown/src/showdown.js",
                        "js/node_modules/bootstrap/dist/js/bootstrap.js",
                        "js/app/tags.js",
                        "js/app/notes.js",
                        "js/app/app.js",
                    ],
                    'css'     => [
                        "css/note.css",
                        "js/node_modules/bootstrap/dist/css/bootstrap.css",
                        "js/node_modules/font-awesome/css/font-awesome.css",
                    ],
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
