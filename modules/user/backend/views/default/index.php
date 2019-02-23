<?php

use widgets\RowView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';

?>
<div class="container">
    <div class="row justify-content-end">
        <div class="col-auto">
            <a class="btn btn-green" href="<?= Url::to(['create']) ?>">Создать</a>
        </div>
    </div>
    <div class="divider"></div>
    <?= $row = RowView::widget([
        'dataProvider' => $dataProvider,
        'attrLabel' => true,
        'columns' => [
            'username',
            'email',
            'roleName',
            'statusName',
        ],
    ]) ?>
</div>