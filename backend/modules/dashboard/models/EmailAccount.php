<?php

namespace backend\modules\dashboard\models;

/**
 * This is the model class for table "email_accounts".
 *
 * @property int $id
 * @property string|null $email_address
 * @property string $send_from
 * @property int|null $is_default
 * @property string|null $host
 * @property string|null $port
 * @property string|null $password
 * @property string|null $username
 * @property string|null $encryption
 */
class EmailAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['send_from'], 'required'],
            [['is_default'], 'integer'],
            [['email_address', 'send_from', 'host'], 'string', 'max' => 80],
            [['port'], 'string', 'max' => 10],
            [['password', 'username'], 'string', 'max' => 100],
            [['encryption'], 'string', 'max' => 15],
            [['email_address'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_address' => 'Email Address',
            'send_from' => 'Send From',
            'is_default' => 'Is Default',
            'host' => 'Host',
            'port' => 'Port',
            'password' => 'Password',
            'username' => 'Username',
            'encryption' => 'Encryption',
        ];
    }

    public static function getDefaultSender()
    {
        return self::find()->where(['is_default' => 1])->one();
    }

    public static function findByEmail($email)
    {
        return self::find()->where(['email_address' => $email])->one();
    }

    public function getParams()
    {
        return [
            'host' => $this->host,
            'port' => $this->port,
            'password' => $this->password,
            'username' => $this->username,
            'encryption' => $this->encryption
        ];
    }
}
