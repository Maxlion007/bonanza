<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'homeUrl' => '/adminpanel',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
    ],
    'aliases' => [
        '@staticRoot' => $params['staticPath'],
        '@static' => $params['staticHostInfo'],
    ],

    'controllerNamespace' => 'backend\controllers',

    'components' => [
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//                ],
//            ],
//        ],
        'request' => [
            'baseUrl'=>'/adminpanel',
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'backend\entities\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'bonanza',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
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

        'backendUrlManager' => require __DIR__ . '/urlManager.php',
        'frontendUrlManger' => require __DIR__ . '/../../frontend/config/urlManager.php',
        'urlManager' => function () {
            return Yii::$app->get('backendUrlManager');
        },

        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'except' => ['login', 'error'],
            'rules' => [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'on beforeRequest' => function () {
        $pathInfo = Yii::$app->request->pathInfo;
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
            Yii::$app->response->redirect('/' . substr(rtrim($pathInfo), 0, -1), 301)->send();
        }
    },
    'params' => $params,
];
