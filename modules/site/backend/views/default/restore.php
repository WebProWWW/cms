<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-04 09:40
 */

/* @var modules\site\models\FormRestore $model */

use widgets\Form;
use yii\helpers\Html;

$this->title = 'Восстановление';
?>
<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="wall">
                <?php $form = Form::begin([ 'model'=>$model ]) ?>
                    <?= $form->inputTextWithError('email') ?>
                    <?= $form->submit('Восстановить') ?>
                    <p class="text text-right em-9">
                        <?= Html::a('Войти', [ '/site/default/login' ]) ?>
                    </p>
                <?php Form::end() ?>
            </div>
        </div>
    </div>
</div>