<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * Class BlockHtml
 * @package modules\site\models
 *
 * @property int $id
 * @property string $description
 * @property string $content
 * @property string $view
 * @property string $blockTitle
 * @property string $blockContent
 * @property string $blockDescription
 */
class BlockHtml extends ActiveRecord implements BlockInterface
{

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
            // if ($insert) {}
            $this->content = Html::encode($this->content);
            return true;
        }
        return false;
    }


    public function getBlockTitle()
    {
        return 'Блок html';
    }


    public function getBlockContent()
    {
        return Html::decode($this->content);
    }


    public function getBlockDescription()
    {
        return $this->description;
    }


    public function getView()
    {
        return 'html';
    }
}
