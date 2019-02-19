<?php

use widgets\NavTiled;

use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог';

?>
<div class="mt-auto">
    <?= NavTiled::widget(['items'=>[
        [
            'text' => 'Категории',
            'url' => ['/catalog/category/index'],
            'icon' => '<i class="fas fa-sitemap"></i>',
        ],
        [
            'text' => 'Товары',
            'url' => ['/catalog/product/index'],
            'icon' => '<i class="fas fa-shopping-cart"></i>',
        ],
    ]]) ?>
</div>