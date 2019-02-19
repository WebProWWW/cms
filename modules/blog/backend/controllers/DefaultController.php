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

    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = [
            'url' => ['index'],
            'label' => 'Блог',
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => Post::find()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionCreate()
    {
        $model = new Post();
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


    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
