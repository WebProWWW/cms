<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:05
 */

namespace assets;


use yii\web\AssetBundle;

class JQuery extends AssetBundle
{
    public $sourcePath = '@vendor/jquery/jquery/dist';
    public $js = ['jquery.min.js'];
}