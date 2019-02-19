<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-12 05:25
 */

use widgets\Form;

use yii\helpers\Html;

/* @var \yii\web\View $this */
/* @var \modules\page\models\BlockHtml $model */

$this->title = 'Блок html';
$this->params['breadcrumbs'][] = 'html';
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
            <?= $form->textareaWithLabelError('content', [
                'input' => ['class' => 'd-none']
            ]) ?>
            <div class="ace-editor">
                <div data-ace="<?= $form->getInputId('content') ?>"></div>
            </div>
        </div>
    <?php Form::end() ?>
</div>