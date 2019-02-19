<?php

namespace modules\site\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property int $default
 * @property int $active
 * @property int $order
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $keywords
 * @property string $content_title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PageBlock[] $pageBlocks
 */
class PageG extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['default', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'created_at', 'updated_at'], 'required'],
            [['title', 'alias', 'description', 'keywords', 'content_title'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'default' => 'Default',
            'active' => 'Active',
            'order' => 'Order',
            'title' => 'Title',
            'alias' => 'Alias',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'content_title' => 'Content Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageBlocks()
    {
        return $this->hasMany(PageBlock::className(), ['page_id' => 'id']);
    }
}
