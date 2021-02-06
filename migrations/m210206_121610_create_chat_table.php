<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m210206_121610_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'message' => $this->text()->notNull(),
            'date_pub' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'author' => $this->text()->notNull(),
            'incorrect' => $this->boolean()->notNull(),
        ], 'CHARSET=utf8 COLLATE utf8_general_ci');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
