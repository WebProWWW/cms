<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 20:32
 */

use widgets\Breadcrumbs;
use widgets\Tabs;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var \yii\web\View $this */
/* @var string $content */

?>
<?php $this->beginContent('@modules/site/backend/views/layouts/base.php') ?>

<div class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <a class="header-ln" href="<?= Url::home() ?>">
                    <?= Html::img('@web/img/logo-color.svg', [
                        'height' => 13,
                    ]) ?>
                    <span class="pl-1">CMS</span>
                </a>
            </div><!-- /.col -->
            <div class="col-auto ml-auto">
                <div class="dropdown">
                    <a class="header-ln js-prevent">
                    <span class="mr-1">
                        <?= Yii::$app->user->identity->username ?>
                    </span>
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-content" id="dropdown-user">
                        <a class="dropdown-ln" href="<?= Url::to(['/site/profile/index']) ?>">
                            <i class="fas fa-cog fa-fw"></i>
                            <span class="ml-1">Профиль</span>
                        </a>
                        <a class="dropdown-ln" href="<?= Url::to(['/site/default/logout']) ?>">
                            <i class="fas fa-sign-out-alt fa-fw"></i>
                            <span class="ml-1">Выйти</span>
                        </a>
                    </div><!-- /.dropdown-content -->
                </div><!-- /.dropdown -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.header -->

<?php if ($breadcrumbs = ArrayHelper::getValue($this->params, 'breadcrumbs')): ?>
<div class="container">
    <?= Breadcrumbs::widget(['links'=>$breadcrumbs]) ?>
</div>
<?php endif ?>
<?php if ($tabs = ArrayHelper::getValue($this->params, 'tabs')): ?>
    <div class="container">
        <?= Tabs::widget(['items' => $tabs]) ?>
    </div>
<?php endif ?>

<?= $content ?>

<div class="footer">
    <div class="container mt-20px">
        <div class="d-flex justify-content-center align-items-center em-8">
            <div>
                <a href="https://webprowww.github.io" target="_blank">WebPRO</a>
            </div>
            <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
            <div>
                <a href="https://www.yiiframework.com" target="_blank">
                    <?= Html::img('@web/img/yii_logo_dark.svg', [
                        'class' => 'd-block',
                        'height' => 14,
                    ]) ?>
                </a>
            </div>
            <?php if (YII_ENV_DEV): ?>
                <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
                <div>
                    <a href="<?= Url::to(['/gii']) ?>" target="_blank">Gii</a>
                </div>
            <?php endif ?>
        </div><!-- /.d-flex -->
    </div><!-- /.container -->
</div><!-- /.footer -->

<?php $this->endContent() ?>