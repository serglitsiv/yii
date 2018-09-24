<?php

use yii\db\Migration;

/**
 * Class m180214_174839_menu
 */
class m180214_174839_menu extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180214_174839_menu cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
             'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(50)->notNull(),
            'text' => $this->string(1000),
        ]);


    }

    public function down()
    {
        echo "m180214_174839_menu cannot be reverted.\n";

        return false;
    }

}
