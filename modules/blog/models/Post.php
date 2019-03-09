<?php

namespace modules\blog\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $category_id
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
 *
 * @property PostCategory $category
 */
class Post extends ActiveRecord
{

    public $imageFile;

    public static function tableName() { return 'post'; }
    public function behaviors() { return [ TimestampBehavior::class ]; }


    public function rules()
    {
        return [
            [['category_id', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'content_title', 'content_desc'], 'required'],
            [['content'], 'string'],
            [['title', 'alias', 'description', 'keywords', 'content_img', 'content_title', 'content_desc'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
        if ($file = UploadedFile::getInstance($this, 'imageFile')) {
            $path = dirname(Yii::getAlias('@webroot'));
            $fileName = Yii::$app->security->generateRandomString(6);
            $imgUrl = '/img/blog/' . $fileName . '.jpg';
            $file->saveAs($path . $imgUrl);
            Image::crop($path . $imgUrl, 600, 600)->save($path . $imgUrl);
            $this->content_img = $imgUrl;
        }
        $this->content = Html::encode($this->content);
        return parent::beforeSave($insert);
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->content = Html::decode($this->content);
    }


    public function deleteImage()
    {
        $path = dirname(Yii::getAlias('@webroot'));
        if (file_exists($path . $this->content_img)) {
            unlink($path . $this->content_img);
        }
        $this->content_img = null;
        $this->save(false);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'category_id']);
    }
}
