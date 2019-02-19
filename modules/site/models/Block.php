<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Block
 * @package modules\page\models
 *
 * @property int $id
 * @property integer $model_id
 * @property string $model_class
 *
 * @property ActiveRecord $block
 *
 */
class Block extends ActiveRecord
{

    public static function tableName() { return 'block'; }

    public function rules()
    {
        return [
            [['model_id', 'model_class'], 'required'],
            [['model_class'], 'string', 'max' => 255],
            [['model_id'], 'integer'],
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->block->delete();
    }

    /**
     * @param string $arrayKey
     * @return bool|string
     */
    public static function getClassName($arrayKey)
    {
        $models = [
            'BlockHtml' => BlockHtml::class,
            'BlockSlider' => BlockSlider::class,
        ];
        if (key_exists($arrayKey, $models)) {
            return $models[$arrayKey];
        }
        return false;
    }

    /**
     * @param string $arrayKey
     * @return null|ActiveRecord
     * @throws \yii\base\InvalidConfigException
     */
    public static function createModel($arrayKey)
    {
        if ($className = self::getClassName($arrayKey)) {
            return Yii::createObject($className);
        }
        return null;
    }

    /**
     * @param int|string $id
     * @return ActiveRecord
     */
    public static function findModel($id)
    {
        return self::findOne(['id' => $id])->block;
    }


//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'title' => 'Название',
//            'description' => 'Описание',
//            'model_class_name' => 'Class',
//        ];
//    }

    public function getBlock()
    {
        return $this->model_class::findOne(['id' => $this->model_id]);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     * @throws \yii\base\InvalidConfigException
//     */
//    public function getPageBlocks()
//    {
//        return $this
//            ->hasMany(Page::class, ['id' => 'page_id'])
//            ->viaTable('page_block', ['block_id' => 'id']);
//    }

}
