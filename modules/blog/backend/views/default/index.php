<?php

use widgets\RowView;

use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = 'Посты';

?>
<div class="container">

    <div class="row">
        <div class="col-auto ml-auto">
            <a class="btn btn-green" href="<?= Url::to(['create']) ?>">Создать пост</a>
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
        'sortable' => ['url' => ['/blog/default/sort']],
    ]) ?>

</div>