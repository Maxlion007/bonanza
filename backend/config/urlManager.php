<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 24.05.17
 * Time: 20:29
 */

return [
//    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['backendHostInfo'],
//    'enablePrettyUrl' => true,
//    'showScriptName' => false,
    'class' => \common\i18n\I18nUrlManager::className(),
    'enableStrictParsing' => false,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'baseUrl' => '/adminpanel',
//    'baseUrl' => '/',
    'languages' => ['es', 'ru'],
    'aliases' => ['es' => 'es', 'ru' => 'ru'],
    'rules' => [
        '' => 'site/index',
        '<_a:login|logout>' => 'site/<_a>',

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];