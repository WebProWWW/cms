<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;
use yii\helpers\Url;

/* @var \modules\blog\models\Post $model */

?>
<div class="container">
    <?php $form = Form::begin([
        'model' => $model,
        'opt' => ['enctype' => 'multipart/form-data'],
    ]) ?>
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
            <?= $form->label('content_img') ?>
            <div class="imglist js-form-images">
                <?php if ($model->content_img): ?>
                    <div class="imglist-item">
                        <a href="<?= Url::to([
                            '/site/blog/post/delete-image',
                            'id' => $model->id,
                        ]) ?>">
                                <span class="imglist-remove">
                                    <i class="fas fa-times fa-fw"></i>
                                </span>
                        </a>
                        <img class="imglist-saved-img" width="110" height="110" src="<?= $model->content_img ?>" alt="">
                    </div>
                <?php endif; ?>
                <div class="imglist-add-btn js-form-image-add" data-single-file data-input-name="<?= $form->getInputName('imageFile') ?>">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
            <?= $form->error('imageFile') ?>
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
        <div class="mt-25px"></div>
        <?= $form->textarea('content', [
            'data-tinymce' => $form->getInputId('content'),
            'rows' => 10
        ]) ?>
    <?php Form::end() ?>
</div>