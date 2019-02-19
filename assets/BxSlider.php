<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-03 05:54
 */

namespace assets;


use yii\web\AssetBundle;

class BxSlider extends AssetBundle
{
    public $sourcePath = '@vendor/stevenwanderski/bxslider-4/dist';
    public $js = ['jquery.bxslider.min.js'];
    public $css = ['jquery.bxslider.min.css'];
    public $depends = [JQuery::class];

}