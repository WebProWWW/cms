<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:06
 */

namespace assets;


use yii\web\AssetBundle;

class FancyBox extends AssetBundle
{
    public $sourcePath = '@vendor/fancyapps/fancybox/dist';
    public $css = ['jquery.fancybox.min.css'];
    public $js = ['jquery.fancybox.min.js'];
    public $depends = [JQuery::class];
}