<?php

namespace backend\modules\dashboard\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "email_templates".
 *
 * @property int $id
 * @property string $name
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $created_at
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['body'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'subject'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'subject' => 'Subject',
            'body' => 'Body',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->created_at = time();
        }
        return true;
    }

    public static function dropDownList()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'name');
    }

}
