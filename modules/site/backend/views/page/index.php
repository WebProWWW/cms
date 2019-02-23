<?php

use widgets\RowView;

use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \yii\data\ActiveDataProvider $defaultData */

$this->title = 'Страницы';

$this->params['breadcrumbs'][] = 'Список';

?>
<div class="container">
    <div class="row">
        <div class="col-auto ml-auto">
            <a class="btn btn-green" href="<?= Url::to(['create']) ?>">Создать страницу</a>
        </div>
    </div>
    <?= RowView::widget([
        'dataProvider' => $defaultData,
        'actions' => ['update', 'view'],
        'columns' => [
            [
                'value' => 'title',
                'class' => 'col-12 clip mt-5px',
            ],
            'description',
        ],
    ]) ?>
    <div class="divider"></div>
    <?= RowView::widget([
        'dataProvider' => $dataProvider,
        'sortable' => ['url' => ['sort']],
        'columns' => [
            [
                'value' => 'title',
                'class' => 'col-12 clip mt-5px',
            ],
            'description',
        ],
    ]) ?>
</div>