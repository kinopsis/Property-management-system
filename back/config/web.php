<?php

use yii\helpers\ArrayHelper;
$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'basic',
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'objects' => [
            'class' => 'app\modules\objects\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'defaultRoute' => 'main/default/index',
    'components' => [
        'user' => [
            'identityClass' => 'app\modules\user\models\UserRest',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'request' => [
         'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
        ],
        'parsers' => [
            'application/json' => 'yii\web\JsonParser',
        ],
            'cookieValidationKey' => 'h6m8WTnZisskNCYF3oxOeYeLTH-3d-E8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
    ],    
];
 
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
 
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}
return $config;