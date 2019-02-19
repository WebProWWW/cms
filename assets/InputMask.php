<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-20 00:34
 */

namespace assets;


use yii\web\AssetBundle;

class InputMask extends AssetBundle
{
    public $sourcePath = '@vendor/robinherbots/inputmask/dist';
    public $js = [
        'min/jquery.inputmask.bundle.min.js'
    ];
    public $depends = [
        JQuery::class,
    ];
}