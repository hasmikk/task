<?php

use yii\db\Migration;

/**
 * Class m210328_103918_mail_queue_table
 */
class m210328_103918_mail_queue_table extends Migration
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

        $this->createTable('{{%mail_queue}}', [
            'id' => $this->primaryKey(),
            'from' => $this->string(80),
            'to' => $this->string(80)->notNull(),
            'subject' => $this->string()->unique(),
            'body' => $this->text(),
            'status' => $this->tinyInteger(2)->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mail_queue}}');
    }


}
