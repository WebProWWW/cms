<?php

namespace modules\blog\backend\controllers;

use modules\blog\models\Post;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 * @package modules\blog\backend\controllers
 */
class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
