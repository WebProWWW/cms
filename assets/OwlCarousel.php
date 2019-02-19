<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-09 23:06
 */

namespace assets;


use yii\web\AssetBundle;

class OwlCarousel extends AssetBundle
{
    public $sourcePath = '@vendor/OwlCarousel2/OwlCarousel2/dist';
    public $css = ['assets/owl.carousel.min.css'];
    public $js = ['owl.carousel.min.js'];
}