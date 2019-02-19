<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-15 05:53
 */

namespace widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class NavTiled
 * @package widgets
 */
class NavTiled extends Widget
{
    public $items = [];
    public $options = [];

    public function init()
    {
        $this->options = ArrayHelper::merge([
            'container' => [
                'class' => 'container',
            ],
            'col' => [
                'class' => 'col-6 col-sm-4 col-md-3 col-xl-2 pt-1px',
            ],
        ], $this->options);
    }

    public function run()
    {
        $opt = ArrayHelper::getValue($this->options, 'container', []);
        return Html::tag('div', $this->getNavHtml(), $opt);
    }

    private function getNavHtml()
    {
        $content = '';
        foreach ($this->items as $item) {
            $content .= $this->getItemHtml($item);
        }
        return Html::tag('div', $content, [
            'class' => 'row no-gutters align-items-stretch nav'
        ]);
    }

    /**
     * @param array $item
     * item keys: text, url, icon
     *
     * @return string
     */
    private function getItemHtml($item)
    {
        $text = ArrayHelper::getValue($item, 'text', '');
        $url = ArrayHelper::getValue($item, 'url', []);
        $icon = ArrayHelper::getValue($item, 'icon', '');
        $opt = ArrayHelper::getValue($this->options, 'col', []);
        $content = ''
            .Html::tag('span', $icon, ['class' => 'nav-icon'])
            .Html::tag('span', $text, ['class' => 'nav-text'])
        .'';
        $content = Html::a($content, $url, ['class' => 'nav-ln']);
        return Html::tag('div', $content, $opt);
    }
}