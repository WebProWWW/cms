<?php

/* @var \yii\web\View $this */
/* @var \modules\site\models\Page $page */
/* @var \modules\site\models\PageBlock[] $blockModels */

$this->title = $page->title;

?>
<section class="section">
    <div class="container">
        <?php foreach ($blockModels as $model): ?>
            <?= $model->block->content ?>
        <?php endforeach ?>
    </div>
</section>