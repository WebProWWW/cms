<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-16 13:49
 */

use widgets\DetailView;
use widgets\RowView;

use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var \modules\site\models\Page $model */
/* @var \yii\web\View $this */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = 'Просмотр';

?>
<div class="container">

    <?= DetailView::widget([
        'model' => $model,
        'columns' => [
            'title',
            'alias',
            [
                'attr' => 'active',
                'value' => function() use ($model) { return ($model->active) ? 'Да' : 'Нет'; },
                'format' => 'html',
            ],
        ],
        'actions' => ($model->default) ? ['update'] : ['update', 'delete'],
    ]) ?>

    <?= RowView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getPageBlocks()->with('block')->orderBy('order'),
            'sort' => false,
        ]),
        'actions' => [
            function ($block) use ($model) {
                return Html::a('<i class="fas fa-marker fa-fw"></i>', [
                    '/site/block/update',
                    'id' => $block->block->id,
                    'page_id' => $model->id,
                ],[
                    'title' => 'Редактировать',
                    'class' => 'action-btn update',
                ]);
            },
        ],
        'sortable' => ['url' => ['block-sort', 'id' => $model->id]],
        'columns' => [
            [
                'value' => 'block.title',
                'class' => 'label col-12 mt-5px',
            ],
            'block.description',
        ],
    ]) ?>

</div>