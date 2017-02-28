<?php

$params = require(__DIR__ . '/params.php');

use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OsyBAGRxlf6sesDgfn3fxg4yTgLk-f0y',
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'defaultRoute' => 'site/welcome',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'restaurant/view/<id:\d+>' => 'restaurant/view',
                'restaurant/edit/<id:\d+>' => 'restaurant/update',
                'restaurant/delete/<id:\d+>' => 'restaurant/delete',

                //'<controller:(find)>/by/<action:\w+>/try<id:\d+>' => '<controller>/<action>',
                '<controller:(find)>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:(find)>/by/<action:\w+>' => '<controller>/<action>',
                //'find/restaurant/details/<id:\d+>' => 'find/restaurantDetail',

                'admin/<controller:(restaurant|meal|location-type|meal-type|meat)>/<action:\w+>' => '<controller>/<action>',



                'meal-type' => 'mealType',
                'location-type' => 'locationType',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
