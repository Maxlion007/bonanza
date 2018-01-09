<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'bootstrap' => [
        'common\bootstrap\SetUp',
    ],
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\MemCache',
//            'useMemcached' => true,
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'params' => $params,
];
