<?php

namespace modules\site\frontend\controllers;

use modules\site\models\Page;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 * @package modules\site\frontend\controllers
 */
class DefaultController extends Controller
{

    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($alias='index')
    {
        if (($page = Page::findOne(['alias' => $alias])) !== null) {
            return $this->render('index', [
                'page' => $page,
            ]);
        }
        throw new NotFoundHttpException();
    }

}