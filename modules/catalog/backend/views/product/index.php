<?php

use widgets\RowView;

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Каталог';
?>
<div class="container">

    <div class="row justify-content-end">
        <div class="col-auto">
            <?= Html::a('Создать', ['create'], ['class' => 'btn btn-green']) ?>
        </div>
    </div>

    <?= RowView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'value' => 'title',
                'class' => 'col-12 clip mt-5px label',
            ],
            [
                'value' => 'description',
                'class' => 'col-12 clip mt-5px',
            ],
        ],
        'actions' => ['update', 'delete'],
        'sortable' => ['url' => ['/catalog/product/sort']],
    ]) ?>
</div>
