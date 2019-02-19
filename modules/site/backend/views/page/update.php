<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-08 04:11
 */

/* @var \yii\web\View $this */
/* @var \modules\site\models\Page $model */
/* @var \yii\data\ActiveDataProvider $blockDataProvider */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('-form', [
    'model' => $model,
    'blockDataProvider' => $blockDataProvider,
]) ?>