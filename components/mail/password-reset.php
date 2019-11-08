<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-04-09 23:20
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user components\user\Identity */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([
    '/site/default/reset-password',
    'token' => $user->password_reset_token,
]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>.</p>
    <p>Нажмите на ссылку и введите новый пароль:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>