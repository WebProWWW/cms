<?php

/* @var $this yii\web\View */
/* @var $model \modules\user\models\User */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = 'Создать';
?>
<?= $this->render('-form', ['model' => $model]) ?>