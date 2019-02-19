<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "block_html".
 *
 * @property int $id
 * @property string $description
 * @property string $content
 */
class BlockHtml extends ActiveRecord
{
    public $title = 'Блок html';
    public $view = 'html';

    public static function tableName() { return 'block_html'; }

    public function rules()
    {
        return [
            [['description'], 'required'],
            [['content'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание блока',
            'content' => 'Содержимое (html код)',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
//            if ($insert) {}
            $this->content = Html::encode($this->content);
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $model = new Block();
            $model->model_id = $this->id;
            $model->model_class = self::class;
            $model->save(false);
        }
    }

}
