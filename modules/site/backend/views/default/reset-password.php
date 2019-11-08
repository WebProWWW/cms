<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-10 01:30
 */

use widgets\Form;
use yii\helpers\Url;

$this->title = 'Восстановление доступа';
?>
<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="wall">
                <?php $form = Form::begin(['model' => $model]) ?>
                    <?= $form->inputPasswordWithLabelError('password') ?>
                    <?= $form->inputPasswordWithLabelError('password_repeat') ?>
                    <?= $form->submit('Сохранить') ?>
                <?php Form::end() ?>
                <p class="text text-right em-9">
                    <a href="<?= Url::to(['/site/default/login']) ?>">Войти</a>
                </p>
            </div>
        </div>
    </div>
</div>