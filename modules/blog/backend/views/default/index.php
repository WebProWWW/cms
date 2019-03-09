<?php

use widgets\NavTiled;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Блог';

?>
<div class="mt-auto">
    <?= NavTiled::widget(['items'=>[
        [
            'text' => 'Категории',
            'url' => ['/blog/category/index'],
            'icon' => '<i class="fas fa-sitemap"></i>',
        ],
        [
            'text' => 'Посты',
            'url' => ['/blog/post/index'],
            'icon' => '<i class="fas fa-file-alt"></i>',
        ],
    ]]) ?>
</div>