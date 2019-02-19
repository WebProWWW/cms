<?php

use widgets\RowView;
use widgets\NavTiled;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';

$this->params['breadcrumbs'][] = 'Список';
?>
<div class="container">
    <div class="row">
        <div class="col-auto ml-auto">
<!--            <a class="btn btn-green" data-fancybox href="#page-block-type-list">Создать блок</a>-->
            <a class="btn btn-green" href="<?= Url::to(['create', 'view' => 'html', 'key' => 'BlockHtml']) ?>">Создать блок</a>
        </div>
    </div>
    <?= RowView::widget([
        'dataProvider' => $dataProvider,
        'actions' => ['update', 'delete'],
        'columns' => [
            [
                'value' => 'block.title',
                'class' => 'col-12 mt-5px clip label',
            ],
            [
                'value' => 'block.description',
                'class' => 'col-12 mt-5px clip',
            ],
        ],
    ]) ?>
</div>

<div class="d-none">
    <div class="modal modal-xl" id="page-block-type-list">
        <?= NavTiled::widget(['items'=>[
            [
                'text' => 'Слайдер',
                'url' => [
                    'create',
                    'view' => 'slider',
                    'key' => 'BlockSlider',
                ],
                'icon' => '<i class="fas fa-images"></i>',
            ],
            [
                'text' => 'HTML код',
                'url' => [
                    'create',
                    'view' => 'html',
                    'key' => 'BlockHtml',
                ],
                'icon' => '<i class="fas fa-file-code"></i>',
            ],
        ]]) ?>
    </div>
</div>