<?php

use widgets\Form;
use components\user\Access;

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model modules\site\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">

    <?php $form = Form::begin(['model' => $model]) ?>
        <div class="row justify-content-end">
            <div class="col-auto">
                <?= $form->submit('Сохранить') ?>
            </div>
        </div>
        <div class="wall">
            <?= $form->inputTextWithLabelError('username') ?>
            <?= $form->inputTextWithLabelError('email') ?>
            <?= $form->dropdownWithLabelError('status', Access::statuses()) ?>
            <?= $form->dropdownWithLabelError('role', Access::roles()) ?>
        </div>
        <div class="wall mt-1px">
            <?= $form->inputPasswordWithLabelError('password') ?>
            <?= $form->inputPasswordWithLabelError('password_repeat') ?>
        </div>
    <?php Form::end() ?>

</div>