<?php

namespace modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property int $order
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $keywords
 * @property string $content_img
 * @property string $content_title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Product[] $products
 */
class ProductCategory extends ActiveRecord
{
    public $imageFile;

    public static function tableName() { return 'product_category'; }


    public function behaviors()
    {
        return [ TimestampBehavior::class ];
    }


    public function rules()
    {
        return [
            [['order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'content_title'], 'required'],
            [['title', 'alias', 'description', 'keywords', 'content_img', 'content_title', 'content_desc'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'title' => 'Название (title)',
            'alias' => 'Псевдоним (url)',
            'description' => 'Описание страницы (meta description)',
            'keywords' => 'Ключевые слова (meta keywords)',
            'content_img' => 'Фото',
            'content_title' => 'Заголовок (h1)',
            'content_desc' => 'Описание',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($file = UploadedFile::getInstance($this, 'imageFile')) {
                $path = dirname(Yii::getAlias('@webroot'));
                $fileName = Yii::$app->security->generateRandomString(6);
                $imgUrl = '/img/catalog/' . $fileName . '.jpg';
                $file->saveAs($path . $imgUrl);
                Image::resize($path . $imgUrl, 600, 600)->save($path . $imgUrl);
                $this->content_img = $imgUrl;
            }
            return true;
        }
        return false;
    }

    public function deleteImage()
    {
        $path = dirname(Yii::getAlias('@webroot'));
        unlink($path . $this->content_img);
        $this->content_img = null;
        $this->save(false);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }
}
