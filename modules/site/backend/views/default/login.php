<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-07 01:08
 */

use widgets\Form;

/* @var \yii\web\View $this */
/* @var \modules\site\backend\models\FormModel $model */

$this->title = 'Авторизация'
?>
<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="wall">
                <?php $form = Form::begin(['model'=>$model]) ?>
                    <?= $form->inputTextWithError('email') ?>
                    <?= $form->inputPasswordWithError('password') ?>
                    <?= $form->checkbox('remember') ?>
                    <?= $form->submit('Войти') ?>
                <?php Form::end() ?>
            </div>
        </div>
    </div>
</div>