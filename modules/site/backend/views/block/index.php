<?php

use modules\site\models\Block;
use widgets\RowView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';

$this->params['breadcrumbs'][] = 'Список';
?>
<div class="container">
    <div class="row justify-content-end mt-20px">
        <div class="col-12 col-sm-6 col-md-auto">
            <a class="btn btn-green mt-1px" href="<?= Url::to([
                'create',
                'view'     => Block::HTML_VIEW,
                'key'      => Block::HTML_KEY,
            ]) ?>">Создать (html)</a>
        </div>
        <div class="col-12 col-sm-6 col-md-auto">
            <a class="btn btn-green mt-1px" href="<?= Url::to([
                'create',
                'view'     => Block::HTML_EDITOR_VIEW,
                'key'      => Block::HTML_EDITOR_KEY,
            ]) ?>">Создать (html редактор)</a>
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