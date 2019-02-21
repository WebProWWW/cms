<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;

/**
 *
 * Class Block
 * @package modules\page\models
 *
 * @property int $id
 * @property int $model_id
 * @property string $content
 * @property string $title
 * @property string $description
 * @property ActiveRecord | BlockInterface | null $model_class
 * @property ActiveRecord | BlockInterface | null $model
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
        $this->model->delete();
    }

    /**
     * @param string $arrayKey
     * @return bool|string
     */
    public static function getClassName($arrayKey)
    {
        $models = [
            'BlockHtml' => BlockHtml::class,
        ];
        if (key_exists($arrayKey, $models)) {
            return $models[$arrayKey];
        }
        return null;
    }

    /**
     * @param string $arrayKey
     * @return null | ActiveRecord
     */
    public static function createModel($arrayKey)
    {
        /* @var ActiveRecord | null $model */
        $model = null;
        if ($className = self::getClassName($arrayKey)) {
            try {
                $model = Yii::createObject($className);
            } catch (\Exception $exception) {}
        }
        return $model;
    }

    /**
     * @param int | string $id
     * @return null | ActiveRecord | BlockInterface
     */
    public static function findModel($id)
    {
        return self::findOne(['id' => $id])->model;
    }


    /**
     * @return null | ActiveRecord | BlockInterface
     */
    public function getModel()
    {
        try {
            return $this->model_class::findOne(['id' => $this->model_id]);
        } catch (\Exception $exception) {}
        return null;
    }

    public function getContent() { return $this->model->blockContent; }

    public function getTitle() { return $this->model->blockTitle; }

    public function getDescription() { return $this->model->blockDescription; }

}
