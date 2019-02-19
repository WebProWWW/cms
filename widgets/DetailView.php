<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-16 16:56
 */

namespace widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Class DetailView
 * @package widgets
 *
 * @property ActiveRecord $model
 */
class DetailView extends Widget
{

    public $model;
    public $columns = [];
    public $actions = ['update', 'delete'];

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function run()
    {
        if ($this->model === null) {
            return '';
        }
        return $this->renderContent();
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    private function renderContent()
    {
        $content = '';
        foreach ($this->columns as $type) {
            $content .= $this->getRow($type);
        }
        $content = $content.$this->getActionsGroup();
        return Html::tag('div', $content, ['class' => 'wall px-0 pb-0']);
    }

    /**
     * @param string $type
     * @return string
     * @throws InvalidConfigException
     */
    private function getRow($type)
    {
        if (is_string($type)) {
            return $this->getColumnTypeString($this->pregMatch($type));
        }
        if (is_array($type)) {
            return $this->getColumnTypeArray($type);
        }
        return '';
    }

    /**
     * @param array $opt ['attr', 'format']
     * @return string
     */
    private function getColumnTypeString($opt)
    {
        $attr = ArrayHelper::remove($opt, 'attr');
        $format = ArrayHelper::remove($opt, 'format');
        $label = $this->model->getAttributeLabel($attr);
        try {
            $value = ArrayHelper::getValue($this->model, $attr);
        } catch (\Exception $exception) {
            $value = '-';
            $format = 'text';
        }
        return $this->getColHtml($label, Yii::$app->formatter->format($value, $format));
    }

    /**
     * @param array $opt ['attr', 'format', opt...]
     * @return string
     */
    private function getColumnTypeArray($opt=[])
    {
        $attr = ArrayHelper::remove($opt, 'attr');
        $value = ArrayHelper::remove($opt, 'value');
        $format = ArrayHelper::remove($opt, 'format', 'text');
        $label = $this->model->getAttributeLabel($attr);
        $formatter = Yii::$app->formatter;
        if (is_string($value)) {
            try {
                $value = ArrayHelper::getValue($this->model, $value);
            } catch (\Exception $exception) {}
            return $this->getColHtml($label, $formatter->format($value, $format), $opt);
        }
        if (is_callable($value)) {
            $value = call_user_func($value);
            return $this->getColHtml($label, $formatter->format($value, $format), $opt);
        }
        try {
            $value = ArrayHelper::getValue($this->model, $attr);
        } catch (\Exception $exception) {
            $value = '';
            $format = 'text';
        }
        return $this->getColHtml($label, $formatter->format($value, $format), $opt);
    }

    /**
     * @param string $label
     * @param string $value
     * @param array $opt ['label', 'value', 'row']
     * @return string
     */
    private function getColHtml($label, $value, $opt=[])
    {
        $optRow = ArrayHelper::getValue($opt, 'optRow', []);
        $optLabel = ArrayHelper::getValue($opt, 'optLabel', []);
        $optValue = ArrayHelper::getValue($opt, 'optValue', []);
        $content = ''
            .Html::tag('div', $label, ArrayHelper::merge([
                'class' => 'label pl-0 clip'
            ], $optLabel))
            .Html::tag('div', $value, ArrayHelper::merge([
                'class' => 'clip'
            ], $optValue))
        .'';
        return Html::tag('div', $content, ArrayHelper::merge([
            'class' => 'px-35px'
        ], $optRow));
    }

    /**
     * @param string $text
     * @return array
     * @throws InvalidConfigException
     */
    private function pregMatch($text) {
        if (!preg_match('/^([^:]+)(:(\w*))?$/', $text, $matches)) {
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
     * @return string
     */
    private function getActionsGroup()
    {
        $content = '';
        foreach ($this->actions as $action) {
            $content .= $this->getActionBtn($action);
        }
        return Html::tag('div', $content, ['class' => 'action-row mt-25px']);
    }

    /**
     * @param callable|string $type
     * @return string
     *
     * if $type is 'custom':
     * ['text', 'url', Html::a options]
     *
     * if $type is callable:
     * function ($model) {}
     */
    public function getActionBtn($type)
    {
        if ($type === 'update') {
            return Html::a('<i class="fas fa-marker fa-fw"></i>', [
                'update', 'id' => $this->model->id,
            ], [
                'class' => 'action-btn update',
                'title' => 'Редактировать',
            ]);
        }
        if ($type === 'delete') {
            return Html::a('<i class="fas fa-trash-alt fa-fw"></i>', [
                'delete', 'id' => $this->model->id,
            ], [
                'class' => 'action-btn delete',
                'data-rowview-confirm' => 'Вы действительно хотите удалить запись ?',
                'title' => 'Удалить',
            ]);
        }
        if (is_array($type)) {
            $text = ArrayHelper::remove($type, 'text', '<i class="fas fa-genderless fa-fw"></i>');
            $url = ArrayHelper::remove($type, 'url', false);
            return Html::a($text, $url, ArrayHelper::merge([
                'class' => 'action-btn'
            ], $type));
        }
        if (is_callable($type)) {
            return call_user_func($type);
        }
        return '';
    }

}