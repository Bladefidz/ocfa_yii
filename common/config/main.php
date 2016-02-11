<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'homeUrl' => '/ocfa_yii/common',
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
