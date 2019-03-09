<?php

namespace modules\blog\backend\controllers;

use modules\blog\models\PostCategory;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class CategoryController
 * @package modules\blog\backend\controllers
 */
class CategoryController extends Controller
{

    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = [
            'url' => ['index'],
            'label' => 'Категории',
        ];
    }


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => PostCategory::find()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }


    public function actionCreate()
    {
        $model = new PostCategory();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    public function actionDeleteImage($id)
    {
        $model = $this->findModel($id);
        $model->deleteImage();
        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * @param $id
     * @return PostCategory|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = PostCategory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
