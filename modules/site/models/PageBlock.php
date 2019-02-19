<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_block".
 *
 * @property int $id
 * @property int $order
 * @property int $page_id
 * @property int $block_id
 *
 * @property Block $block
 * @property Page $page
 */
class PageBlock extends ActiveRecord
{

    public static function tableName() { return 'page_block'; }

    public function rules()
    {
        return [
            [['order', 'page_id', 'block_id'], 'integer'],
            [['page_id', 'block_id'], 'required'],
            [['block_id'], 'exist', 'skipOnError' => true, 'targetClass' => Block::class, 'targetAttribute' => ['block_id' => 'id']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::class, ['id' => 'block_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }
}
