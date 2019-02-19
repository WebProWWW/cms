<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 20:01
 */

return [
    'id'               => 'yii-cms',
    'charset'          => 'utf-8',
    'language'         => 'ru-RU',
    'sourceLanguage'   => 'ru-RU',
    'timeZone'         => 'Europe/Moscow',
    'basePath'         => '@app',
    'vendorPath'       => '@vendor',
    'bootstrap'        => ['log'],
    'aliases'          => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
    ],
    'components' => [
        'formatter' => [
            'dateFormat'       => 'dd.MM.Y',
            'timeFormat'       => 'HH:mm',
            'datetimeFormat'   => 'dd.MM.Y HH:mm',
        ],
        'request' => [
            'csrfParam'             => '_csrf-cms',
            'cookieValidationKey'   => '0yMC0WcaTEcxq3e3Q8-DZxBw5-bwaUEQ',
        ],
        'session' => [
            'name' => '_sess-cms',
        ],
        'log' => [
            'traceLevel'  => 0, // YII_DEBUG ? 3 : 0
            'targets'     => [
                [
                    'class'    => \yii\log\FileTarget::class,
                    'levels'   => ['error', 'warning'],
                ],
            ],
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class
        ],
        'user' => [
            'identityClass'    => \components\user\Identity::class,
            'enableAutoLogin'  => true,
            'loginUrl'         => ['/site/default/login'],
            'identityCookie'   => ['name'=>'_identity-cms','httpOnly'=>true],
        ],
        'authManager' => [
            'class' => \components\user\AuthManager::class,
        ],
        'db'      => require __DIR__.'/db.php',
        'mailer'  => require __DIR__.'/mailer.php',
    ],
];