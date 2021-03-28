<?php

namespace common\models;

use backend\modules\dashboard\models\MailQueue;
use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string $password
 * @property string $email
 * @property int|null $created_at
 */
class Student extends \yii\db\ActiveRecord
{

    public $new_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'email'], 'required'],
            [['new_password'], 'safe'],
            [['email'], 'email'],
            [['created_at'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 80],
            [['username'], 'string', 'max' => 20],
            [['password', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        return true;
    }

    public function sendMail($mailFrom, $mailTo, $subject, $body)
    {
        if (empty($mailTo)) {
            return;
        }
        try {
            MailQueue::addToQueue($mailFrom, $mailTo, $subject, $body);
            return true;

        } catch (\Exception $e) {
            return false;
        }

    }

}
