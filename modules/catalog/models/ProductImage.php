<?php

namespace modules\catalog\models;

use Yii;

/**
 * This is the model class for table "product_image".
 *
 * @property int $id
 * @property int $product_id
 * @property string $src
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{

    public static function tableName() { return 'product_image'; }


    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['src'], 'required'],
            [['src'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'src' => 'Src',
        ];
    }


    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
