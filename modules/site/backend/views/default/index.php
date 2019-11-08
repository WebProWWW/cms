<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-03 16:56
 */

use widgets\NavTiled;

/* @var yii\web\View $this */

$this->title = 'Меню'

?>
<div class="mt-auto">
    <?= NavTiled::widget(['items'=>[
        [
            'text' => 'Страницы',
            'url' => ['/site/page/index'],
            'icon' => '<i class="fas fa-sitemap"></i>',
        ],
        [
            'text' => 'Блоки',
            'url' => ['/site/block/index'],
            'icon' => '<i class="fas fa-file-invoice"></i>',
        ],
        [
            'text' => 'Каталог',
            'url' => ['/site/catalog/default/index'],
            'icon' => '<i class="fas fa-shopping-bag"></i>',
        ],
        [
            'text' => 'Блог',
            'url' => ['/site/blog/default/index'],
            'icon' => '<i class="fas fa-blog"></i>',
        ],
        [
            'text' => 'Пользователи',
            'url' => ['/site/user/default/index'],
            'icon' => '<i class="fas fa-users"></i>',
        ],
        [
            'text' => 'Настройки',
            'url' => ['/site/settings/index'],
            'icon' => '<i class="fas fa-cog"></i>',
        ],
    ]]) ?>
</div>