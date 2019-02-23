<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 19:58
 */

return [
    'name'     => 'CMS',
    'version'  => '2.0',
    'modules'  => [
        'site'   => [
            'class'    => \modules\site\backend\Module::class,
            'modules'  => [
                'catalog'  => ['class' => \modules\catalog\backend\Module::class],
                'blog'     => ['class' => \modules\blog\backend\Module::class],
                'user'     => [ 'class' => \modules\user\backend\Module::class ],
            ],
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl'      => true,
            'enableStrictParsing'  => false,
            'showScriptName'       => false,
            'suffix'               => '.html',
            'rules' => [
                [
                    'class' =>  \yii\web\GroupUrlRule::class,
                    'routePrefix' => 'site',
                    'rules' => [
                        '<action:[\w\-]+>' => 'default/<action>',
                        '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
                        '<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
                    ],
                ],
                '' => '/site/default/index',
            ],
        ],
    ],
];