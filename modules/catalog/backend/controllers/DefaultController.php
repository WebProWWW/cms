<?php

namespace modules\catalog\backend\controllers;

use yii\web\Controller;

/**
 * Class DefaultController
 * @package modules\catalog\backend\controllers
 */
class DefaultController extends Controller
{

    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = 'Каталог';
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

}
