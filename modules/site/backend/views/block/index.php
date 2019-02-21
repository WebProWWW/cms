<?php

use widgets\RowView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';

$this->params['breadcrumbs'][] = 'Список';
?>
<div class="container">
    <div class="row">
        <div class="col-auto ml-auto">
            <a class="btn btn-green" href="<?= Url::to(['create', 'view' => 'html', 'key' => 'BlockHtml']) ?>">Создать блок</a>
        </div>
    </div>
    <?= RowView::widget([
        'dataProvider' => $dataProvider,
        'actions' => ['update', 'delete'],
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