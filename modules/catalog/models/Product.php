<?php

namespace modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property int $active
 * @property int $order
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $keywords
 * @property string $content_title
 * @property string $content_desc
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductCategory $category
 * @property ProductImage[] $images
 * @property ProductImage $image
 *
 * @property array $categoryItems
 */
class Product extends ActiveRecord
{

    public static function tableName() { return 'product'; }

    public function behaviors()
    {
        return [ TimestampBehavior::class ];
    }

    public function rules()
    {
        return [
            [['category_id', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'content_title', 'content_desc'], 'required'],
            [['title', 'alias', 'description', 'keywords', 'content_title', 'content_desc'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Сортировка',
            'category_id' => 'Категория',
            'active' => 'Опубликован',
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

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }

    public function getCategoryItems()
    {
        $categories =  ProductCategory::find()->all();
        return ArrayHelper::map($categories, 'id','title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ProductImage::class, ['product_id' => 'id']);
    }

}
