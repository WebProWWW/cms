<?php

namespace modules\site\frontend\controllers;

use modules\site\models\Page;

use yii\data\ActiveDataProvider;
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
            $dataProvider = new ActiveDataProvider([
                'query' => $page->getPageBlocks()->with('block')->orderBy('order'),
                'sort' => false,
            ]);
            return $this->render('index', [
                'page' => $page,
                'blockModels' => $dataProvider->models,
            ]);
        }
        throw new NotFoundHttpException();
    }

}