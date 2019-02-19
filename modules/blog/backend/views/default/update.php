<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-08 04:11
 */

/* @var \yii\web\View $this */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = 'Редактировать пост';
?>
<?= $this->render('-form', ['model'=>$model]) ?>