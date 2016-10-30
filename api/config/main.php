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
    'controllerNamespace' => 'api\controllers',
    'modules' => [
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

        /*'urlManager' => [
            'class'=>'webvimark\behaviors\multilanguage\MultiLanguageUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                '<_c:[\w \-]+>/<id:\d+>'=>'<_c>/view',
                '<_c:[\w \-]+>/<_a:[\w \-]+>/<id:\d+>'=>'<_c>/<_a>',
                '<_c:[\w \-]+>/<_a:[\w \-]+>'=>'<_c>/<_a>',

                '<_m:[\w \-]+>/<_c:[\w \-]+>/<_a:[\w \-]+>'=>'<_m>/<_c>/<_a>',
                '<_m:[\w \-]+>/<_c:[\w \-]+>/<_a:[\w \-]+>/<id:\d+>'=>'<_m>/<_c>/<_a>',
            ],
        ],*/

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
    ],
    'params' => $params,
    'aliases' => [
        '@api' => '@common/../api',
    ],
];
