<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:05
 */

namespace assets;


use yii\web\AssetBundle;

class JQueryUIJS extends AssetBundle
{
    public $sourcePath = '@vendor/jquery/jquery-ui';
    public $js = ['jquery-ui.min.js'];
    public $depends = [JQuery::class];
}