<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class BlockSlider
 * @package modules\page\models
 *
 * @property int $id
 * @property string $description
 *
 * @property BlockSliderSlide $slide
 * @property BlockSliderSlide[] $slides
 */
class BlockSlider extends ActiveRecord
{

    public $title = 'Блок слайдер';
    public $view = 'slider';

    private $_slide;

    public static function tableName() { return 'block_slider'; }

    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание блока',
            'slides' => 'Слайды',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlides()
    {
        return $this->hasMany(BlockSliderSlide::class, ['slider_id' => 'id']);
    }

    public function getSlide()
    {
        if ($this->_slide === null) $this->_slide = new BlockSliderSlide();
        return $this->_slide;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $model = new Block();
            $model->model_id = $this->id;
            $model->model_class = self::class;
            $model->save(false);
        }
    }
}
