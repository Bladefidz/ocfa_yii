<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v0' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v0\Module'
        ],
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'controllerNamespace' => [
        'api\modules\v1\controllers',
        'api\modules\v0\controllers'
    ],
    'homeUrl' => '/ocfa_yii/api',
    'components' => [        
        'user' => [
            'identityClass' => 'api\common\models\User',
            'enableAutoLogin' => false,
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
        'request' => [
            'baseUrl' => '/ocfa_yii/api',
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'enableStrictParsing' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //         [
        //             'class' => 'yii\rest\UrlRule', 
        //             'controller' => 'v1/penduduk',
        //             'tokens' => [
        //                 '{id}' => '<id:\\w+>'
        //             ]
        //         ]
        //     ],        
        // ]
    ],
    'params' => $params,
];