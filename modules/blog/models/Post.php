<?php

namespace modules\blog\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $active
 * @property int $order
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $keywords
 * @property string $content_img
 * @property string $content_title
 * @property string $content_desc
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class Post extends ActiveRecord
{

    public static function tableName() { return 'post'; }

    public function behaviors()
    {
        return [ TimestampBehavior::class ];
    }

    public function rules()
    {
        return [
            [['active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'content_title', 'content_desc'], 'required'],
            [['content'], 'string'],
            [['title', 'alias', 'description', 'keywords', 'content_img', 'content_title', 'content_desc'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Опубликован',
            'order' => 'Сортировка',
            'title' => 'Название (title)',
            'alias' => 'Псевдоним (url)',
            'description' => 'Описание страницы (meta description)',
            'keywords' => 'Ключевые слова (meta keywords)',
            'content_img' => 'Изображение',
            'content_title' => 'Заголовок (h1)',
            'content_desc' => 'Краткое опсание',
            'content' => 'Содержимое',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->content = Html::encode($this->content);
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->content = Html::decode($this->content);
    }
}
