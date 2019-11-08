<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 21:38
 */

namespace modules\site\backend;

use yii\web\AssetBundle;

/**
 * Class Asset
 * @package modules\site\backend\assets
 */
class Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css?v=001',
    ];
    public $js = [
        'js/main.js?v=001',
    ];
}