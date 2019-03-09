<?php

namespace modules\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

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
 * @property UploadedFile[] $imageFiles
 * @property ProductImage[] $images
 *
 * @property array $categoryItems
 *
 */
class Product extends ActiveRecord
{
    public $imageFiles = [];


    public static function tableName() { return 'product'; }
    public function behaviors() { return [ TimestampBehavior::class ]; }


    public function rules()
    {
        return [
            [['category_id', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'content_title', 'content_desc'], 'required'],
            [['title', 'alias', 'description', 'keywords', 'content_title'], 'string', 'max' => 255],
            [['content_desc'], 'string'],
            [['alias'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Сортировка',
            'category_id' => 'Категория',
            'active' => 'Опубликован',
            'images' => 'Фото',
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


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $path = dirname(Yii::getAlias('@webroot'));
        foreach (UploadedFile::getInstances($this, 'imageFiles') as $file) {
            $fileName = Yii::$app->security->generateRandomString(6);
            $orgUrl = '/img/catalog/' . 'org-' . $fileName . '.' . $file->extension;
            $mdUrl = '/img/catalog/' . 'md-' . $fileName . '.jpg';
            $thumbUrl = '/img/catalog/' . 'th-' . $fileName . '.jpg';
            $file->saveAs($path . $orgUrl);
            Image::resize($path . $orgUrl, 150, 150)->save($path . $thumbUrl);
            Image::resize($path . $orgUrl, 600, 600)->save($path . $mdUrl);
            $productImage = new ProductImage([
                'org' => $orgUrl,
                'md' => $mdUrl,
                'thumb' => $thumbUrl,
            ]);
            $productImage->save(false);
            $productImage->link('product', $this);
        }
    }

    public function deleteImage($id)
    {
        $path = dirname(Yii::getAlias('@webroot'));
        $image = ProductImage::findOne(['id' => $id]);
        $this->deleteImageFiles([
            $path . $image->org,
            $path . $image->md,
            $path . $image->thumb,
        ]);
        $image->unlink('product', $this, true);
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

    /**
     * @param array $files
     */
    private function deleteImageFiles($files=[])
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

}
