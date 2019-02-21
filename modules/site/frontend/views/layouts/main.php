<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-20 18:44
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var \yii\web\View $this */
/* @var string $content */

$baseUrl = Url::base(true);

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $baseUrl ?>/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $baseUrl ?>/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $baseUrl ?>/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $baseUrl ?>/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= $baseUrl ?>/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= $baseUrl ?>/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?= $baseUrl ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= $baseUrl ?>/favicon-16x16.png" sizes="16x16">
    <meta name="application-name" content="<?= Yii::$app->name ?>">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?= $baseUrl ?>/mstile-144x144.png">
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="header">
    <p>header</p>
</header>

<div class="wrapper">
    <?= $content ?>
</div>

<footer class="footer">
    <p>footer</p>
</footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>