<?php

use yii\db\Migration;

/**
 * Class m210326_175428_students_table
 */
class m210326_175428_students_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%students}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(80),
            'last_name' => $this->string(80),
            'username' => $this->string(20)->unique(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%students}}');
    }
}
