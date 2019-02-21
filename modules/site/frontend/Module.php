<?php

namespace modules\site\frontend;

/**
 * site module definition class
 */
class Module extends \yii\base\Module
{

    public $controllerNamespace = 'modules\site\frontend\controllers';
    public $layout = 'main';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
