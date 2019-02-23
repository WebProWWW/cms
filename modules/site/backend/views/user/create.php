<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\site\models\User */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = 'Создать';
?>
<?= $this->render('-form', ['model' => $model]) ?>