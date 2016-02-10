<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'homeUrl' => '/ocfa_yii/common',
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mandrillapp.com',
                'username' => 'api.dev@ocfa.go.id',
                'password' => '2Mxi325jZBWaOiUJCd8qpw',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            // 'rules' => array(
            //     '<controller:\w+>/<id:\d+>' => '<controller>/view',
            //     '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            //     '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            // ),
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'Asia/Jakarta',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-M-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
        ]
    ],
];
