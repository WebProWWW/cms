<?php

namespace modules\catalog\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_image".
 *
 * @property int $id
 * @property int $product_id
 * @property int $order
 * @property string $org
 * @property string $md
 * @property string $thumb
 *
 * @property Product $product
 */
class ProductImage extends ActiveRecord
{
    public $imageFiles;

    public static function tableName() { return 'product_image'; }

    public function rules()
    {
        return [
            [['product_id', 'order'], 'integer'],
//            [['org', 'md', 'thumb'], 'required'],
//            [['org', 'md', 'thumb'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'order' => 'Order',
            'org' => 'Org',
            'md' => 'Md',
            'thumb' => 'Thumb',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

}
