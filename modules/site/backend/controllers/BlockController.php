<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-15 19:52
 */

namespace modules\site\backend\controllers;

use modules\site\models\Block;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class BlockController extends Controller
{

    public function init()
    {
        parent::init();
        $this->view->params['breadcrumbs'][] = [
            'url' => ['index'],
            'label' => 'Блоки',
        ];
    }


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Block::find(),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionUpdate($id, $page_id=null)
    {
        $model = Block::findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($page_id !== null) {
                return $this->redirect(['/site/page/view', 'id' => $page_id]);
            }
            return $this->redirect(['index']);
        }
        return $this->render($model->view, ['model'=>$model]);
    }


    public function actionCreate($view, $key)
    {
        $model = Block::createModel($key);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        }
        return $this->render($view, ['model'=>$model]);
    }

    public function actionDelete($id)
    {
        Block::findOne(['id'=>$id])->delete();
        return $this->redirect(['index']);
    }

}