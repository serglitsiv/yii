<?php
use \kartik\datecontrol\Module;
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','gii','debug'],
    'modules' => [
        'gii'=>[
            'class'=>'yii\gii\Module'
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*', '127.0.0.1', '::1']
        ],
        'blog' => [
            'class' => 'common\modules\blog\Blog',
        ],
        'datecontrol' =>  [
             'class' => '\kartik\datecontrol\Module',
             'displaySettings' => [
            Module::FORMAT_DATE => 'php:d-M-Y',
            Module::FORMAT_TIME => 'php:H:i',
            Module::FORMAT_DATETIME => 'php:d/m/Y H:i',
             ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'yyyy-M-dd', // saves as unix timestamp
                Module::FORMAT_TIME => 'H:i:s',
                Module::FORMAT_DATETIME => 'yyyy-M-dd H:i:s',
            ],
            'displayTimezone' => 'UTC',
            'saveTimezone' => 'UTC',
            'autoWidget' => true,
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        ]

    ],
    'components' => [

        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'yii2-backend',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru_RU',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-m-Y H:i',
        ],


    ],
    'params' => $params,
];
