<?php

namespace modules\site\backend\controllers;

use components\user\Access;
use modules\site\models\FormLogin;

use Yii;
use yii\web\Controller;

/**
 * Class DefaultController
 * @package modules\site\backend\controllers
 */
class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (Yii::$app->user->identity->role === Access::ROLE_ADMIN) {
            return $this->goHome();
        }
        $this->layout = 'base';
        $model = new FormLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        $model->password = '';
        return $this->render('login', ['model'=>$model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}