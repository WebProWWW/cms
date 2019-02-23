<?php

namespace modules\site\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\BadRequestHttpException;

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
 * @property string $action
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Block[] $blocks
 */
class Page extends ActiveRecord
{

    public $blocks_ids = [];

    public static function tableName() { return 'page'; }

    public function behaviors()
    {
        return [ TimestampBehavior::class ];
    }

    public function rules()
    {
        return [
            [['active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias', 'active'], 'required'],
            [['title', 'alias', 'description', 'keywords', 'content_title', 'action'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['action'], 'required', 'message' => 'Необходимо выбрать "Содержимое"'],
            [['blocks_ids'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Опубликован',
            'order' => 'Сортировка',
            'title' => 'Название (title)',
            'alias' => 'Псевдоним (url)',
            'description' => 'Описание страницы (meta description)',
            'keywords' => 'Ключевые слова (meta keywords)',
            'content_title' => 'Заголовок (h1)',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getBlocks()
    {
        return $this
            ->hasMany(Block::class, ['id'=>'block_id'])
            ->viaTable('page_block', ['page_id'=>'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageBlocks()
    {
        return $this->hasMany(PageBlock::class, ['page_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->linkBlocks();
        parent::afterSave($insert, $changedAttributes);
    }

    private function linkBlocks()
    {
        $this->unlinkAll('blocks', true);
        foreach ($this->blocks_ids as $blockId => $val) {
            $block = Block::findOne(['id' => $blockId]);
            $this->link('blocks', $block);
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function getChecked($id)
    {
        foreach ($this->blocks as $block) {
            if ($block->id === $id) {
                return 'checked';
            }
        }
        foreach ($this->blocks_ids as $blockId => $val) {
            if ($blockId === $id) {
                return 'checked';
            }
        }
        return '';
    }

    public function updateBlockOrder($orders)
    {
        if (!is_array($orders)) {
            throw new BadRequestHttpException('Invalid {orders} parameter');
        }
        $command = self::getDb()->createCommand();
        foreach ($orders as $order => $id) {
            try { $command->update(PageBlock::tableName(), ['order' => $order], ['id' => $id])->execute(); }
            catch (\Exception $e) { return $e->getMessage(); }
        }
        return 'Orders update success';
    }

}
