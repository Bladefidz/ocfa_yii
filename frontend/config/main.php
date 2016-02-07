<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'homeUrl' => '/ocfa_yii',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => true
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'request' => [
            'baseUrl' => '/ocfa_yii',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'defaultRoute' => 'frontend/index',
                'api_doc' => 'site/apidoc',
                'tentang' => 'site/tentang',
                'signup' => 'site/signup',
                'login' => 'site/login',
                'logout' => 'site/logout',
            ],
        ],
        
    ],
    'params' => $params,
	'name'=>'OCFA System',
];
