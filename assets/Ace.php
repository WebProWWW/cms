<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-11 08:57
 */

namespace assets;


use yii\web\AssetBundle;

class Ace extends AssetBundle
{
    public $sourcePath = '@vendor/ajaxorg/ace-builds/src-min';
    public $js = ['ace.js'];
}