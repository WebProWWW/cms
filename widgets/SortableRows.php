<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-12 04:57
 */

namespace widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;


/**
 * Class RowView
 * @package app\widgets
 * @property ActiveDataProvider $dataProvider
 */
class SortableRows extends Widget
{

    public $dataProvider;
    public $filterModel;
    public $timestamp = false;
    public $cols;

    private $colMatch = '/^([^:]+)(:(\w*))?$/'; //'/^([^:]+)(:(\w*))?(:(.*))?$/'


    public function init() { parent::init(); }


    public function run()
    {
        $rowColHtmlArr = [];
        foreach ($this->dataProvider->models as $model) {
            try {
                $rowColHtmlArr[] = $this->renderRowColData($model, $this->cols);
            } catch (InvalidConfigException $e) {
                return $e->getMessage();
            }
        }
        return $this->render('sortable-rows', ['rowColHtmlArr' => $rowColHtmlArr]);
    }


    /**
     * @param ActiveRecord $model
     * @param array $cols
     * @return string
     * @throws InvalidConfigException
     */
    private function renderRowColData($model, $cols)
    {
        $items = [];
        foreach ($cols as $key => $col) {
            if (is_string($col)) {
                $items[] = $this->getColItem($model, $this->pregMatch($col));
            } elseif (is_callable($col)) {
                $items[] = $this->getColItem($model, $this->pregMatch($key), $col($model));
            }
        }
        return $this->render('sortable-rows-data', ['items'=>$items]);
    }


    /**
     * @param $text
     * @return array
     * @throws InvalidConfigException
     */
    private function pregMatch($text) {
        if (!preg_match($this->colMatch, $text, $matches)) {
            throw new InvalidConfigException('The col must be specified in the format of "attribute", "attribute:format"');
        }
        $attr = $matches[1];
        $format = isset($matches[3]) ? $matches[3] : 'text';
        return [
            'attr'   => $attr,
            'format' => $format
        ];
    }


    /**
     * @param ActiveRecord $model
     *
     * @param array $matches ['attr', 'format']
     * @see SortableRows::pregMatch()
     *
     * @param bool|string $forceVal
     * @return array ['label, 'value']
     */
    private function getColItem($model, $matches, $forceVal=false)
    {
        $attr = $matches['attr'];
        $format = $matches['format'];
        $value = $forceVal ? $forceVal : $model->getAttribute($attr);
        $value = Yii::$app->formatter->format($value, $format);
        return [
            'label' => $model->getAttributeLabel($attr),
            'value' => $value,
        ];
    }


}
