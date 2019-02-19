<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-15 19:32
 */

namespace modules\site\backend\controllers;


use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}