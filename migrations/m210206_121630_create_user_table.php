<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210206_121630_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->text()->notNull(),
            'password' => $this->text()->notNull(),
            'is_admin' => $this->boolean()->notNull(),
            'authKey' => $this->text()->notNull(),
            'accessToken' => $this->text()->notNull(),
        ], 'CHARSET=utf8 COLLATE utf8_general_ci');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
