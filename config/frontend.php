<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 19:59
 */

return [
    'name'     => 'CMS',
    'version'  => '2.0',
    'modules'  => [
        'site'   => [
            'class'    => \modules\site\frontend\Module::class,
            'modules'  => [
//                'catalog'  => ['class' => \modules\catalog\frontend\Module::class], // TODO catalog frontend module
//                'blog'     => ['class' => \modules\blog\frontend\Module::class], // TODO blog frontend module
                'user'     => [ 'class' => \modules\user\frontend\Module::class ],
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