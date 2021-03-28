<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Class m210326_161915_addUser
 */
class m210326_161915_addUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{user}}', [
            'id' => 300,
            'username' => 'admin',
            'auth_key' => 'nmJL51O6urbQ70BkNAZSuvuqN0km5l1t',
            'password_hash' => '$2y$13$YWEDbViOeyjUaAFADkcQYeZd1pX7dmpl1oswE.RHck/uEwPXPElJm',
            'password_reset_token' => '',
            'status' => 10,
            'email' => 'hasmik.karakashyan@gmail.com',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


}
