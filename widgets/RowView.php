<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-13 21:19
 */

namespace widgets;

use Yii;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

/**
 * Class RowView
 * @package widgets
 *
 * @property ActiveDataProvider $dataProvider
 * @property string $title
 * @property string $desc
 */
class RowView extends Widget
{
    public $dataProvider;
    public $actions = ['delete', 'update', 'view'];
    public $sortable = false; // ['url']
    public $columns = [];
    public $attrLabel = false;
    public $afterContent;

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function run()
    {
        if ($this->dataProvider === null) {
            return '';
        }
        return ''
            .$this->renderContent()
            .Pagination::widget(['dataProvider' => $this->dataProvider])
        .'';
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    private function renderContent()
    {
        $rows = '';
        foreach ($this->dataProvider->models as $model) {
            $rows .= $this->getRow($model);
        }
        $opt = [];
        if (is_array($this->sortable)) {
            $opt = [
                'data-sortable' => Url::to(ArrayHelper::getValue($this->sortable, 'url', []))
            ];
        }
        return Html::tag('div', $rows, $opt);
    }

    /**
     * @param ActiveRecord $model
     * @return string
     * @throws InvalidConfigException
     */
    private function getRow($model)
    {
        $content = $this->getContent($model);
        return Html::tag('div', $content, [
            'class' => 'row no-gutters align-items-stretch row-view',
            'data-sortable-item' => $model->id,
        ]);
    }

    /**
     * @param ActiveRecord $model
     * @return string
     * @throws InvalidConfigException
     */
    private function getContent($model)
    {
        $sortable = is_array($this->sortable);
        $content = '';
        foreach ($this->columns as $type) {
            $content .= $this->getColumn($model, $type);
        }
        $content = Html::tag('div', $content, ['class' => 'row row-view-content']);
        $content = Html::tag('div', $content, ['class' => 'col clip']);
        if ($sortable) {
            $sortableIcon = '<i class="fas fa-bars"></i>';
            $sortableCol = Html::tag('div', $sortableIcon, ['class' => 'row-view-sort js-sortable-btn']);
            $sortableCol = Html::tag('div', $sortableCol, ['class' => 'col-auto']);
            $content = $sortableCol . $content;
        }
        $content = $content . $this->getAfterContent($model);
        $content = Html::tag('div', $content, ['class' => 'row no-gutters']);
        $content = Html::tag('div', $content, ['class' => 'col-12 col-md clip']);
        $content .= Html::tag('div','', ['class' => 'row-view-divider d-md-none']);
        $content .= Html::tag('div', $this->getActionsGroup($model), ['class' => 'col-12 col-md-auto']);
        return $content;
    }

    /**
     * @param ActiveRecord $model
     * @return string
     */
    private function getAfterContent($model)
    {
        if (is_callable($this->afterContent)) {
            return call_user_func($this->afterContent, $model);
        }
        if (is_string($this->afterContent)) {
            return $this->afterContent;
        }
        return '';
    }

    /**
     * @param ActiveRecord $model
     * @param string|array|callable $type
     * @return string
     * @throws InvalidConfigException
     */
    private function getColumn($model, $type)
    {
        if (is_string($type)) {
            return $this->getColumnTypeString($model, $this->pregMatch($type));
        }
        if (is_array($type)) {
            return $this->getColumnTypeArray($model, $type);
        }
        if (is_callable($type)) {
            return $this->getColHtml(call_user_func($type, $model));
        }
        return '';
    }

    /**
     * @param ActiveRecord $model
     * @param array $opt
     * @return string
     */
    private function getColumnTypeArray($model, $opt=[])
    {
        $value = ArrayHelper::remove($opt, 'value');
        $format = ArrayHelper::remove($opt, 'format', 'text');
        $attrLabel = ArrayHelper::remove($opt, 'attrLabel', $this->attrLabel);
        if (is_string($value)) {
            $attr = $value;
            try {
                $value = ArrayHelper::getValue($model, $value);
            } catch (\Exception $exception) {}
            $content = ''
                .$this->getColLabel($model, $attr)
                .Yii::$app->formatter->format($value, $format)
            .'';
            return $this->getColHtml($content, $opt);
        }
        if (is_callable($value)) {
            return $this->getColHtml(call_user_func($value, $model), $opt);
        }
        return '';
    }

    /**
     * @param ActiveRecord $model
     * @param array $opt
     * @return string
     */
    private function getColumnTypeString($model, $opt)
    {
        $attr = ArrayHelper::remove($opt, 'attr');
        $format = ArrayHelper::remove($opt, 'format');
        try {
            $value = ArrayHelper::getValue($model, $attr);
        } catch (\Exception $exception) {
            $value = '';
            $format = 'text';
        }
        $content = ''
            .$this->getColLabel($model, $attr)
            .Yii::$app->formatter->format($value, $format)
        .'';
        return $this->getColHtml($content);
    }

    /**
     * @param string $content
     * @param array $opt
     * @return string
     */
    private function getColHtml($content, $opt=[])
    {
        return Html::tag('div', $content, ArrayHelper::merge([
            'class' => 'col clip mt-5px'
        ], $opt));
    }

    /**
     * @param ActiveRecord $model
     * @param string $attr
     * @param array $opt
     * @return string
     */
    private function getColLabel($model, $attr, $opt=[])
    {
        try {
            $content = $model->getAttributeLabel($attr);
        } catch (\Exception $exception) {
            return '';
        }
        if ($this->attrLabel) {
            return Html::tag('span', $content, ArrayHelper::merge([
                'class' => 'label mp-0',
            ], $opt));
        }
        return '';
    }

    /**
     * @param $text
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
     * @param ActiveRecord $model
     * @return string
     */
    private function getActionsGroup($model)
    {
        $content = '';
        foreach ($this->actions as $type) {
            $content .= $this->getActionBtn($model, $type);
        }
        return Html::tag('div', $content, ['class' => 'action-row']);
    }

    /**
     * @param ActiveRecord $model
     * @param callable|string $type
     * @return string
     *
     * if $type is 'custom':
     * ['text', 'url', Html::a options]
     *
     * if $type is callable:
     * function ($model) {}
     */
    public function getActionBtn($model, $type)
    {
        if (is_callable($type)) {
            return call_user_func($type, $model);
        }
        $btnType = $type;
        $id = ArrayHelper::getValue($model, 'id');
        $url = false;
        $opt = [
            'text' => '<i class="fas fa-genderless fa-fw"></i>',
            'class' => 'action-btn',
        ];
        if (is_array($type) && key_exists('type', $type)) {
            $btnType = ArrayHelper::remove($type, 'type');
        }
        if ($btnType === 'update') {
            $opt = ArrayHelper::merge($opt, [
                'text' => '<i class="fas fa-marker fa-fw"></i>',
                'title' => 'Редактировать',
                'class' => 'action-btn update',
            ]);
            $url = ['update', 'id' => $id];
        }
        if ($btnType === 'view') {
            $opt = ArrayHelper::merge($opt, [
                'text' => '<i class="fas fa-eye fa-fw"></i>',
                'title' => 'Просмотр',
                'class' => 'action-btn view',
            ]);
            $url = ['view', 'id' => $id];
        }
        if ($btnType === 'delete') {
            $opt = ArrayHelper::merge($opt, [
                'text' => '<i class="fas fa-trash-alt fa-fw"></i>',
                'title' => 'Удалить',
                'class' => 'action-btn delete',
                'data-rowview-confirm' => 'Вы действительно хотите удалить запись ?',
            ]);
            $url = ['delete', 'id' => $id];
        }
        if (is_array($type)) {
            $opt = ArrayHelper::merge($opt, $type);
            $url = ArrayHelper::remove($type, 'url', $url);
        }
        $text = ArrayHelper::remove($opt, 'text');
        return Html::a($text, $url, $opt);
    }
}