<?php

use yii\db\Migration;

/**
 * Class m210328_143759_email_accounts_table
 */
class m210328_143759_email_accounts_table extends Migration
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

        $this->createTable('{{%email_accounts}}', [
            'id' => $this->primaryKey(),
            'email_address' => $this->string(80)->unique(),
            'send_from' => $this->string(80)->notNull(),
            'is_default' => $this->tinyInteger()->defaultValue(0),
            'host' => $this->string(80),
            'port' => $this->string(10),
            'password' => $this->string(100),
            'username' => $this->string(100),
            'encryption' => $this->string(15),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%email_accounts}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210328_143759_email_accounts_table cannot be reverted.\n";

        return false;
    }
    */
}
