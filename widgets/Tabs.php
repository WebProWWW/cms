<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-07 15:45
 */

namespace widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class Tabs
 * @package widgets
 *
 * @property string $itemsHtml
 */
class Tabs extends Widget
{
    public $items;

    public function init()
    {
        parent::init();
        if ($this->items === null) $this->items = [];
    }

    public function run()
    {
        return Html::tag('div', $this->itemsHtml, ['class'=>'tab']);
    }

    /**
     * @return string
     */
    public function getItemsHtml()
    {
        $out = '';
        foreach ($this->items as $item) {
            if (is_array($item)) $out .= $this->renderItem($item);
        }
        return $out;
    }

    /**
     * @param array $item
     * @return string
     */
    private function renderItem($item)
    {
        $active = ArrayHelper::remove($item, 'active', false) ? ' active' : '';
        $options = ArrayHelper::merge([
            'class' => 'tab-ln'.$active,
        ], $item);
        $label = ArrayHelper::remove($options, 'label');
        $url = ArrayHelper::remove($options, 'url');
        return Html::a($label, $url, $options);
    }
}