<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]        
    ],  
    'timeZone'  => 'America/Bogota',  
    'components' => [  
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dGlxao-YW9_9DI4M4k7Lo55EqDuxDwmg',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'transport' => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'mail.parkingplus.es',
                'username'   => 'postmaster@parkingplus.es',
                'password'   => 'parking*mail19',
                'port'       => '465',
                'encryption' => 'ssl',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ],            
        ],

        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php: d-m-Y',
            'datetimeFormat' => 'dd/MM/YYYY HH:mm:ss a',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            //'currencyCode' => ' $',
            'nullDisplay' => '',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 2,
                NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ],
            'timeZone' => 'UTC',
            'locale' => 'es'
        ],        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    */
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
