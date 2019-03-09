<?php

use yii\db\Migration;
use yii\db\Exception;

/**
 * Class m190204_234833_install
 *
 * @property string $options
 * @property array $tables
 */
class m190204_234833_install extends Migration
{
    public function getTables()
    {
        return [
            'user',

            'page',
            'page_block',

            'block',
            'block_html',
            'block_html_editor',
            'block_slider',
            'block_slider_slide',

            'post',
            'post_category',

            'product',
            'product_image',
            'product_category',
        ];
    }

    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->dropTables();
    /**
     * USER
     */
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull(),
            'role' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email_confirm_token' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $this->options);
        $this->createIndex('idx-user-email', 'user', 'email');
        $this->createIndex('idx-user-status', 'user', 'status');
        $this->createIndex('idx-user-role', 'user', 'role');
        $this->createIndex('idx-user-auth_key', 'user', 'auth_key');
        $this->createIndex('idx-user-password_hash', 'user', 'password_hash');
    /**
     * PAGE
     */
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'default' => $this->integer(1)->defaultValue(0),
            'active' => $this->integer(1)->defaultValue(1),
            'order' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'content_title' => $this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'action' => $this->string()->notNull()->defaultValue('/site/default/index'),
        ]);
        $this->createIndex('idx-page-active', 'page', 'active');
        $this->createIndex('idx-page-order', 'page', 'order');
        $this->createIndex('idx-page-alias', 'page', 'alias');
    /**
     * BLOCK
     */
        $this->createTable('block', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'model_class' => $this->string()->notNull(),
        ]);
        $this->createIndex('idx-block-model_id', 'block', 'model_id');
        $this->createIndex('idx-block-model_class', 'block', 'model_class');
    /**
     * PAGE_BLOCK
     */
        $this->createTable('page_block', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->defaultValue(0),
            'page_id' => $this->integer()->notNull(),
            'block_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-page_block-order', 'page_block', 'order');
        $this->addForeignKey('fk-page_block-page', 'page_block', 'page_id', 'page', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-page_block-block', 'page_block', 'block_id', 'block', 'id', 'CASCADE', 'RESTRICT');
    /**
     * BLOCK_HTML
     */
        $this->createTable('block_html', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'content' => $this->longText(),
        ]);
    /**
     * BLOCK_HTML_EDITOR
     */
        $this->createTable('block_html_editor', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'content' => $this->longText(),
        ]);
    /**
     * BLOCK_SLIDER
     */
        $this->createTable('block_slider', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
        ]);
    /**
     * BLOCK_SLIDER_SLIDE
     */
        $this->createTable('block_slider_slide', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->notNull()->defaultValue(0),
            'active' => $this->tinyInteger(1)->defaultValue(1)->notNull(),
            'img' => $this->string()->notNull(),
            'url' => $this->string(),
            'content' => $this->longText(),
            'slider_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-block_slider_slide-active', 'block_slider_slide', 'active');
        $this->createIndex('idx-block_slider_slide-order', 'block_slider_slide', 'order');
        $this->createIndex('idx-block_slider_slide-slider_id', 'block_slider_slide', 'slider_id');
        $this->addForeignKey('fk-block_slider_slide-block_slider', 'block_slider_slide', 'slider_id', 'block_slider', 'id', 'CASCADE', 'RESTRICT');


/**
 * BLOG
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * POST
     */
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->null(),
            'active' => $this->integer(1)->defaultValue(1),
            'order' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'content_th_img' => $this->string()->null(),
            'content_img' => $this->string()->null(),
            'content_title' => $this->string()->notNull(),
            'content_desc' => $this->string()->notNull(),
            'content' => $this->longText()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-post-active', 'post', 'active');
        $this->createIndex('idx-post-order', 'post', 'order');
        $this->createIndex('idx-post-alias', 'post', 'alias');

    /**
     * POST_CATEGORY
     */
        $this->createTable('post_category', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'content_img' => $this->string()->null(),
            'content_title' => $this->string()->notNull(),
            'content_desc' => $this->longText()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-post_category-alias', 'post_category', 'alias');
        $this->createIndex('idx-post_category-order', 'post_category', 'order');
        $this->addForeignKey('fk-post-post_category', 'post', 'category_id', 'post_category', 'id', 'SET NULL', 'RESTRICT');


        /**
         * CATALOG
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    /**
     * PRODUCT_IMAGE
     */
        $this->createTable('product_image', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->null(),
            'order' => $this->integer()->defaultValue(0)->notNull(),
            'org' => $this->string()->notNull(),
            'md' => $this->string()->notNull(),
            'thumb' => $this->string()->notNull(),
        ]);
        $this->createIndex('idx-product_image-product_id', 'product_image', 'product_id');
    /**
     * PRODUCT_CATEGORY
     */
        $this->createTable('product_category', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'content_img' => $this->string()->null(),
            'content_title' => $this->string()->notNull(),
            'content_desc' => $this->longText()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-product_category-alias', 'product_category', 'alias');
        $this->createIndex('idx-product_category-order', 'product_category', 'order');
    /**
     * PRODUCT
     */
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->null(),
            'active' => $this->integer(1)->defaultValue(1),
            'order' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'content_title' => $this->string()->notNull(),
            'content_desc' => $this->longText()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('idx-product-active', 'product', 'active');
        $this->createIndex('idx-product-alias', 'product', 'alias');
        $this->createIndex('idx-product-order', 'product', 'order');
        $this->addForeignKey('fk-product-product_category', 'product', 'category_id', 'product_category', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-product_image', 'product_image', 'product_id', 'product', 'id', 'CASCADE', 'RESTRICT');

        /**
         * INSERT DATA
         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
        $this->insertUser();
        $this->insertDefaultPage();
        $this->insertData();
    }

    /**
     * @return bool|void
     */
    public function safeDown() {
        $this->dropTables();
    }

    /**
     * @return string|null
     */
    public function getOptions()
    {
        if ($this->db->driverName === 'mysql') {
            return 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }
        return null;
    }

    /**
     * @return string
     */
    private function dropTables()
    {
        try {
            $this->db->createCommand("SET foreign_key_checks = 0")->execute();
            foreach ($this->tables as $table) {
                $tableName = $this->db->tablePrefix . $table;
                if ($this->db->getTableSchema($tableName, true) !== null) {
                    $this->dropTable($tableName);
                }
            }
            $this->db->createCommand("SET foreign_key_checks = 1")->execute();
            return 'All Done';
        } catch (Exception $exception) {
            return 'Error: '.$exception->getMessage();
        }
    }

    private function insertDefaultPage()
    {
        $this->batchInsert('page',
             ['default', 'title'   , 'alias', 'content_title', 'created_at', 'updated_at', ],
            [[ 1       , 'Главная' , 'index', 'Главная'      ,  time()     ,  time()     , ]]
        );
    }

    private function insertUser()
    {
        $this->batchInsert('user',['username','email','status','role','auth_key','password_hash','created_at','updated_at'],[
            [
                'Админ',
                'admin@site.com',
                \components\user\Access::STATUS_ACTIVE,
                \components\user\Access::ROLE_ADMIN,
                Yii::$app->security->generateRandomString(32),
                Yii::$app->security->generatePasswordHash('123456'),
                time(),
                time(),
            ],
        ]);
    }

    private function insertData()
    {
        $this->execute(file_get_contents(__DIR__.'/dump.sql'));
        return 'OK';
    }

    private function longText()
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('LONGTEXT');
    }
}
