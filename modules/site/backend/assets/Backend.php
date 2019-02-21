<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 21:38
 */

namespace modules\site\backend\assets;

use assets\Ace;
use assets\BxSlider;
use assets\FancyBox;
use assets\FontAwesome;
use assets\InputMask;
use assets\JQuery;
use assets\JQueryUIJS;
use assets\TinyMCE;
use assets\TwbsGrid;

use yii\web\AssetBundle;

/**
 * Class Backend
 * @package modules\site\backend\assets
 */
class Backend extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/main.js?v=002',
    ];
    public $depends = [
        TwbsGrid::class,
        JQuery::class,
        JQueryUIJS::class,
        InputMask::class,
        BxSlider::class,
        FancyBox::class,
        FontAwesome::class,
        Ace::class,
        TinyMCE::class,
    ];
}