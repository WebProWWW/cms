<?php

use widgets\DetailView;

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\site\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <?= DetailView::widget([
        'model' => $model,
        'columns' => [
            'username',
            'email',
            'statusName',
            'roleName',
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>
</div>