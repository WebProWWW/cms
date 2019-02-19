<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;

/* @var \modules\catalog\models\Product $model */

?>
<div class="container">
    <?php $form = Form::begin(['model'=>$model]) ?>
        <div class="row">
            <div class="col-auto ml-auto">
                <?= $form->submit('Сохранить') ?>
            </div>
        </div>
        <div class="wall">
            <div class="row justify-content-end">
                <div class="col-auto">
                    <?= $form->checkbox('active') ?>
                </div>
            </div>
            <?= $form->dropdownWithLabelError('category_id', $model->categoryItems) ?>
            <?= $form->inputTextWithLabelError('title', ['input'=>[
                'data-page-cyrlat' => $form->getInputId('alias'),
            ]]) ?>
            <?= $form->inputTextWithLabelError('alias') ?>
            <?= $form->textareaWithLabelError('description') ?>
            <?= $form->textareaWithLabelError('keywords') ?>
            <?= $form->inputTextWithLabelError('content_title') ?>
            <?= $form->textareaWithLabelError('content_desc') ?>
        </div>
    <?php Form::end() ?>
</div>