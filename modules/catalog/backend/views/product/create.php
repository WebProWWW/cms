<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\catalog\models\Product */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = 'Создать';
?>
<?= $this->render('-form', ['model' => $model]) ?>