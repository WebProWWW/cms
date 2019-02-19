<?php

namespace modules\catalog\backend\controllers;

use Yii;
use modules\catalog\models\ProductCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class CategoryController
 * @package modules\catalog\backend\controllers
 */
class CategoryController extends Controller
{

    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = [
            'url' => ['/site/catalog/default/index'],
            'label' => 'Каталог',
        ];
        $this->view->params['breadcrumbs'][] = [
            'url' => ['/site/catalog/category/index'],
            'label' => 'Категории',
        ];
    }


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => ProductCategory::find()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }


    public function actionCreate()
    {
        $model = new ProductCategory();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
