<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 03:58
 */

/* @var \yii\web\View $this */

use widgets\Form;

use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var \modules\site\models\BlockSlider $model */

$this->title = 'Блок слайдер';
$this->params['breadcrumbs'][] = 'Слайдер';
?>
<div class="container">
    <?php $form = Form::begin(['model' => $model]) ?>
        <div class="row">
            <div class="col-auto ml-auto">
                <?= $form->submit('Сохранить') ?>
            </div>
        </div>
        <div class="wall">
            <?= $form->inputTextWithLabelError('description') ?>
        </div>
    <?php Form::end() ?>
    <div class="row">
        <div class="col-auto">
            <a class="btn btn-green js-site-slide-add" href="#">Добавить слайд</a>
        </div>
    </div>
</div>