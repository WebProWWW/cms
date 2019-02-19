<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;

/* @var \modules\blog\models\Post $model */

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
            <?= $form->inputTextWithLabelError('title', ['input'=>[
                'data-page-cyrlat' => $form->getInputId('alias'),
            ]]) ?>
            <?= $form->inputTextWithLabelError('alias') ?>
            <?= $form->textareaWithLabelError('description') ?>
            <?= $form->textareaWithLabelError('keywords') ?>
            <?= $form->inputTextWithLabelError('content_title') ?>
            <?= $form->textareaWithLabelError('content_desc') ?>
        </div>
        <div class="mt-25px"></div>
        <?= $form->textarea('content', [
            'data-tinymce' => $form->getInputId('content'),
            'rows' => 10
        ]) ?>
    <?php Form::end() ?>
</div>