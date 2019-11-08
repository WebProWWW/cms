<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 20:32
 */

use modules\site\backend\Asset;

use yii\web\View;
use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var string $content */

$host = Yii::$app->request->hostInfo;

Asset::register($this);

$this->registerJsVar('app', [
    'csrf' => [
        'csrfParam' => Yii::$app->request->csrfParam,
        'csrfToken' => Yii::$app->request->csrfToken,
    ],
], View::POS_HEAD);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode(Yii::$app->name.' - '.$this->title) ?></title>
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="wrapper">
<?= $content ?>
</div>

<div class="d-none">
    <div id="js-loader-html">
        <div class="loader">
            <?= Html::img('@web/img/loader.svg', [
                'height' => 8,
                'class' => 'loader-img'
            ]) ?>
        </div>
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>