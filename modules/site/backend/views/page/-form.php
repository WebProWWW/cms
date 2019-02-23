<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 02:28
 */

use widgets\Form;
use widgets\RowView;

/* @var \modules\site\models\Page $model */
/* @var \yii\data\ActiveDataProvider $blockDataProvider */

?>
<div class="container">
    <?php $form = Form::begin(['model'=>$model]) ?>
        <div class="row">
            <div class="col-auto ml-auto">
                <?= $form->submit('Сохранить') ?>
            </div>
        </div>
        <div class="wall">
            <?php if (!$model->default): ?>
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <?= $form->checkbox('active') ?>
                    </div>
                </div>
            <?php endif ?>
            <?= $form->inputTextWithLabelError('title', ($model->default) ? [] : ['input'=>[
                'data-page-cyrlat' => $form->getInputId('alias'),
            ]]) ?>
            <?php if (!$model->default): ?>
                <?= $form->inputTextWithLabelError('alias') ?>
            <?php endif ?>
            <?= $form->textareaWithLabelError('description') ?>
            <?= $form->textareaWithLabelError('keywords') ?>
            <?= $form->inputTextWithLabelError('content_title') ?>
            <p class="label">Содержимое</p>
            <div class="row no-gutters align-items-stratch radiolist">
                <div class="col-12 col-md mb-1px">
                    <label class="radiolist-label">
                        <?= $form->input('radio', 'action', [
                            'class' => 'radiolist-input',
                            'id' => false,
                            'placeholder' => false,
                            'checked' => ($model->action === '/site/default/index'),
                            'value' => '/site/default/index',
                            'data-tab-item' => '#site-page-content-block',
                        ]) ?>
                        <span class="radiolist-text">
                            <i class="fas fa-check mr-1"></i>
                            Блоки
                        </span>
                    </label>
                </div><!-- .col -->
                <div class="col-12 col-md mb-1px">
                    <label class="radiolist-label">
                        <?= $form->input('radio', 'action', [
                            'class' => 'radiolist-input',
                            'id' => false,
                            'placeholder' => false,
                            'checked' => ($model->action === '/catalog/default/index'),
                            'value' => '/catalog/default/index',
                            'data-tab-item' => '#site-page-content-catalog',
                        ]) ?>
                        <span class="radiolist-text">
                            <i class="fas fa-check mr-1"></i>
                            Каталог
                        </span>
                    </label>
                </div><!-- .col -->
                <div class="col-12 col-md mb-1px">
                    <label class="radiolist-label">
                        <?= $form->input('radio', 'action', [
                            'class' => 'radiolist-input',
                            'id' => false,
                            'placeholder' => false,
                            'checked' => ($model->action === '/blog/default/index'),
                            'value' => '/blog/default/index',
                            'data-tab-item' => '#site-page-content-blog',
                        ]) ?>
                        <span class="radiolist-text">
                            <i class="fas fa-check mr-1"></i>
                            Блог
                        </span>
                    </label>
                </div><!-- .col -->
            </div><!-- .row -->
            <?= $form->error('action') ?>
        </div>

        <div class="tab-content">
            <div class="tab-content-item" id="site-page-content-block">
                <p class="label">Отметьте блоки которые надо отобразить на странице.</p>
                <?= RowView::widget([
                    'dataProvider' => $blockDataProvider,
                    'actions' => [
                        function ($block) use ($form, $model) {
                            /* @var \modules\site\models\Block $block */
                            return ''
                                .'<div class="col-auto ">'
                                    .'<label class="checkbox-label">'
                                        .'<input name="'.$form->getInputName('blocks_ids').'['.$block->id.']" '.$model->getChecked($block->id).' class="checkbox" type="checkbox">'
                                    .'</label>'
                                .'</div>'
                            .'';
                        },
                    ],
                    'columns' => [
                        [
                            'value' => 'title',
                            'class' => 'col-12 mt-5px clip label',
                        ],
                        [
                            'value' => 'description',
                            'class' => 'col-12 mt-5px clip',
                        ],
                    ],
                ]) ?>
            </div>
            <div class="tab-content-item" id="site-page-content-catalog">
                <div class="wall">
                    <p class="text label">Каталог (модуль)</p>
                    <p class="text mt-5px">Вывод списка категорий каталога на странице</p>
                </div>
            </div>
            <div class="tab-content-item" id="site-page-content-blog">
                <div class="wall">
                    <p class="text label">Блог (модуль)</p>
                    <p class="text mt-5px">Вывод списка постов блога на странице</p>
                </div>
            </div>
        </div>

    <?php Form::end() ?>
</div>