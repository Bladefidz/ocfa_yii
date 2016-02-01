<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'homeUrl' => '/ocfa_yii/common',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
