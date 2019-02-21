<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-21 14:48
 */

use widgets\Form;

use yii\helpers\Html;

/* @var \yii\web\View $this */
/* @var \modules\site\models\BlockHtml $model */

$this->title = 'Html редактор';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <?php $form = Form::begin(['model' => $model]) ?>
    <?php $model->content = Html::decode($model->content) ?>
    <div class="row">
        <div class="col-auto ml-auto">
            <?= $form->submit('Сохранить') ?>
        </div>
    </div>
    <div class="wall">
        <?= $form->inputTextWithLabelError('description') ?>
    </div>
    <div class="mt-25px">
        <?= $form->textarea('content', [
            'data-tinymce' => $form->getInputId('content'),
            'rows' => 10
        ]) ?>
    </div>
    <?php Form::end() ?>
</div>