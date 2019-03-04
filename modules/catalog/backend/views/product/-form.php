<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;
use yii\helpers\Url;

/* @var \modules\catalog\models\Product $model */

?>
<div class="container">
    <?php $form = Form::begin(['model' => $model, 'opt' => ['enctype' => 'multipart/form-data']]) ?>
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
            <?= $form->label('images') ?>
            <div class="imglist js-form-images">
                <?php foreach ($model->images as $image): ?>
                    <div class="imglist-item">
                        <a href="<?= Url::to([
                            '/site/catalog/product/delete-image',
                            'imgId' => $image->id,
                            'prodId' => $model->id,
                        ]) ?>">
                            <span class="imglist-remove">
                                <i class="fas fa-times fa-fw"></i>
                            </span>
                        </a>
                        <img class="imglist-saved-img" width="110" height="110" src="<?= $image->thumb ?>" alt="">
                    </div>
                <?php endforeach; ?>
                <div class="imglist-add-btn js-form-image-add" data-input-name="<?= $form->getInputName('imageFiles') ?>[]">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
            <?php //= $form->inputImageWithPreview('images') ?>
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
