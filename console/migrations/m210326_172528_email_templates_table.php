<?php

use yii\db\Migration;

/**
 * Class m210326_172528_email_templates_table
 */
class m210326_172528_email_templates_table extends Migration
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

        $this->createTable('{{%email_templates}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'subject' => $this->string(),
            'body' => $this->text(),
            'created_at' => $this->integer()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%email_templates}}');
    }

}
