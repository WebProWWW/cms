<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:07
 */

namespace assets;


use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = ['css/all.min.css'];
    public $js = ['js/all.min.js'];
}