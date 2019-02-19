<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:05
 */

namespace assets;


use yii\web\AssetBundle;

class TwbsGrid extends AssetBundle
{
    public $sourcePath = '@vendor/twbs/bootstrap/dist/css';
    public $css = ['bootstrap-grid.min.css'];
}