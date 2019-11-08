<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-07 00:48
 */

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var modules\site\models\FormRestore $model */

$this->title = 'Успешная отправка';
?>
<div class="container my-auto">
    <div class="text-center">
        <p class="text">
            Инструкция по восстановлению доступа отправлена на e-mail:
            <span class="green"><?= $model->email ?></span>
        </p>
        <div class="row justify-content-center">
            <div class="col-auto">
                <p class="text">
                    <?= Html::a('Войти', ['/site/default/login'], ['class' => 'btn btn-green']) ?>
                </p>
            </div>
        </div>
    </div>
</div>