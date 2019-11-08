<?php

namespace modules\site\backend;

use components\user\Access;
use yii\filters\AccessControl;

/**
 * Class Module
 * @package modules\site\backend
 */
class Module extends \yii\base\Module
{

    public $controllerNamespace = 'modules\site\backend\controllers';
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'login',
                            'error',
                            'restore',
                            'restore-success',
                            'reset-password',
                        ],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => [ Access::ROLE_ADMIN ],
                    ],
                ],
            ],
        ];
    }
}

/* Class Module */