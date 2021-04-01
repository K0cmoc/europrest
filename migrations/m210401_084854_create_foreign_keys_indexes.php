<?php

use yii\db\Migration;

/**
 * Class m210401_084854_create_foreign_keys_indexes
 */
class m210401_084854_create_foreign_keys_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-category_option-category_id', '{{%category_option}}', 'category_id');
        $this->addForeignKey('fk-category_option-category_id', '{{%category_option}}', 'category_id', '{{%category}}', 'id', 'CASCADE');

        $this->createIndex('idx-category_product-category_id', '{{%category_product}}', 'category_id');
        $this->addForeignKey('fk-category_product-category_id', '{{%category_product}}', 'category_id', '{{%category}}', 'id', 'CASCADE');

        $this->createIndex('idx-category_product-product_id', '{{%category_product}}', 'product_id');
        $this->addForeignKey('fk-category_product-product_id', '{{%category_product}}', 'product_id', '{{%product}}', 'id', 'CASCADE');

        $this->createIndex('idx-product_option-product_id', '{{%product_option}}', 'product_id');
        $this->addForeignKey('fk-product_option-product_id', '{{%product_option}}', 'product_id', '{{%product}}', 'id', 'CASCADE');

        $this->createIndex('idx-product_option-category_option_id', '{{%product_option}}', 'category_option_id');
        $this->addForeignKey('fk-product_option-category_option_id', '{{%product_option}}', 'category_option_id', '{{%category_option}}', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210401_084854_create_foreign_keysIndexes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210401_084854_create_foreign_keysIndexes cannot be reverted.\n";

        return false;
    }
    */
}
