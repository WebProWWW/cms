<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-14 11:41
 */

namespace assets;


use yii\web\AssetBundle;

class TinyMCE extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/tinymce-dist';
    public $js = [
        'tinymce.min.js'
    ];
}