<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "block_html_editor".
 *
 * @property int $id
 * @property string $description
 * @property string $content
 */
class BlockHtmlEditor extends ActiveRecord implements BlockInterface
{
    const VIEW = 'html-editor';


    public static function tableName() { return 'block_html_editor'; }


    public function rules()
    {
        return [
            [['description'], 'required'],
            [['content'], 'string'],
            [['description'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание блока',
            'content' => 'Содержимое',
        ];
    }


    public function beforeSave($insert)
    {
        $this->content = Html::encode($this->content);
        return parent::beforeSave($insert);
    }


    public function getView() { return self::VIEW; }

    public function getBlockTitle() { return 'Html редактор'; }

    public function getBlockContent() { return Html::decode($this->content); }

    public function getBlockDescription() { return $this->description; }
}
