<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;
use yii\helpers\Url;

/* @var \modules\catalog\models\ProductCategory $model */

?>
<div class="container">
    <?php $form = Form::begin(['model'=>$model, 'opt' => ['enctype' => 'multipart/form-data']]) ?>
        <div class="row">
            <div class="col-auto ml-auto">
                <?= $form->submit('Сохранить') ?>
            </div>
        </div>
        <div class="wall">
            <?= $form->label('content_img') ?>
            <div class="imglist js-form-images">
                <?php if ($model->content_img): ?>
                    <div class="imglist-item">
                        <a href="<?= Url::to([
                            '/site/catalog/category/delete-image',
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