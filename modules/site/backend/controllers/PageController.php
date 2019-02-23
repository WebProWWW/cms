<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-15 18:30
 */

namespace modules\site\backend\controllers;


use modules\site\models\Block;
use modules\site\models\Page;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PageController extends Controller
{
    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = [
            'url' => ['index'],
            'label' => 'Страницы',
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find()->where(['not', ['default' => 1]]),
        ]);
        $default = new ActiveDataProvider([
            'query' => Page::find()->where(['default' => 1]),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'defaultData' => $default,
        ]);
    }


    public function actionCreate()
    {
        $model = new Page();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $blockDataProvider = new ActiveDataProvider([
            'query' => Block::find(),
        ]);
        if ($model->action === null) {
            $model->action = '/site/default/index';
        }
        return $this->render('create', [
            'model' => $model,
            'blockDataProvider' => $blockDataProvider,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $blockDataProvider = new ActiveDataProvider([
            'query' => Block::find(),
        ]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'blockDataProvider' => $blockDataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionBlockSort($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ($this->findModel($id))->updateBlockOrder(Yii::$app->request->post('orders'));;
    }

    /**
     * @param int|string $id
     * @return Page|null
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if (($model = Page::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException();
    }
}