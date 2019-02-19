<?php

namespace modules\site\models;

use Yii;

/**
 * This is the model class for table "block_slider_slide".
 *
 * @property int $id
 * @property int $order
 * @property int $active
 * @property string $img
 * @property string $url
 * @property int $url_active
 * @property string $content
 * @property int $slider_id
 *
 * @property BlockSlider $slider
 */
class BlockSliderSlide extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'block_slider_slide';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'active', 'url_active', 'slider_id'], 'integer'],
            [['img', 'slider_id'], 'required'],
            [['content'], 'string'],
            [['img', 'url'], 'string', 'max' => 255],
            [['slider_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockSlider::class, 'targetAttribute' => ['slider_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Сортировка',
            'active' => 'Активный',
            'img' => 'Изображение',
            'url' => 'Ссылка',
            'url_active' => 'Включить ссылку',
            'content' => 'Содержимое',
            'slider_id' => 'ID Слайдера',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(BlockSlider::class, ['id' => 'slider_id']);
    }
}
