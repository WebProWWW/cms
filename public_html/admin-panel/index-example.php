<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 19:53
 */

use yii\web\Application;
use yii\helpers\ArrayHelper;

//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__.'/../../config/bootstrap.php';

(new Application(ArrayHelper::merge(
    require __DIR__.'/../../config/common.php',
    require __DIR__.'/../../config/backend.php',
    require __DIR__.'/../../config/env-debug.php'
)))->run();