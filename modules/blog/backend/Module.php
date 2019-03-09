<?php

namespace modules\blog\backend;

use Yii;

/**
 * Class Module
 * @package modules\blog\backend
 */
class Module extends \yii\base\Module
{

    public $controllerNamespace = 'modules\blog\backend\controllers';


    public function init()
    {
        parent::init();
        Yii::$app->view->params['breadcrumbs'][] = [
            'url' => ['/site/blog/default/index'],
            'label' => 'Блог',
        ];
    }

}
