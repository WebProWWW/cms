<?php

/* @var \yii\web\View $this */
/* @var \modules\site\models\Page $page */

$this->title = $page->title;

?>
<section class="section">
    <div class="container">
        <?php foreach ($page->blocks as $block): ?>
            <?= $block->content ?>
        <?php endforeach ?>
    </div>
</section>