<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "mail_queue".
 *
 * @property int $id
 * @property string|null $from
 * @property string $to
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class MailQueue extends \yii\db\ActiveRecord
{

    const STATUS_PENDING = 1;

    const STATUS_SENT = 2;

    const STATUS_ERROR = 3;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mail_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['to'], 'required'],
            [['body'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['from', 'to'], 'string', 'max' => 80],
            [['subject'], 'string', 'max' => 255],
            [['subject'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'subject' => 'Subject',
            'body' => 'Body',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function addToQueue($from, $to, $subject, $body)
    {
        $new = new MailQueue();
        $new->from = $from;
        $new->to = $to;
        $new->subject = $subject;
        $new->body = $body;
        $new->created_at = time();
        $new->updated_at = time();
        $new->save();
    }


    public static function sendFromQueue()
    {

        try {
            $mails = self::find()->where(['!=','status',  self::STATUS_SENT])->all();
            if (!empty($mails)) {
                foreach ($mails as $mail) {
                    $sender = EmailAccount::findByEmail($mail->from);
                    if($sender){
                        $params = $sender->params;
                        $params['class'] = 'Swift_SmtpTransport';
                        Yii::$app->mailer->setTransport($params);

                        $message = Yii::$app->mailer->compose()
                            ->setFrom([$mail->from])
                            ->setTo(trim($mail->to))
                            ->setSubject($mail->subject)
                            ->setHtmlBody($mail->body);

                        if ($message->send()) {
                            $mail->status = MailQueue::STATUS_SENT;
                        } else {
                            $mail->status = MailQueue::STATUS_ERROR;
                        }
                        $mail->updated_at = time();
                        $mail->save();
                    }
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
        }

    }

    public static function getStatusDropDown()
    {
        return [
            self::STATUS_PENDING => self::statusName(self::STATUS_PENDING),
            self::STATUS_SENT => self::statusName(self::STATUS_SENT),
            self::STATUS_ERROR => self::statusName(self::STATUS_ERROR),
        ];
    }

    public static function statusName(int $status)
    {
        switch ($status) {
            case self::STATUS_PENDING :
                return 'Pending';
                break;
            case self::STATUS_SENT :
                return 'Sent';
                break;
            case self::STATUS_ERROR :
                return 'Error';
                break;
        }
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return '<span class="label label-info">' . self::statusName(self::STATUS_PENDING) . '</span>';
            case self::STATUS_SENT:
                return '<span class="label label-success">' . self::statusName(self::STATUS_SENT) . '</span>';
            case self::STATUS_ERROR:
                return '<span class="label label-danger">' . self::statusName(self::STATUS_ERROR) . '</span>';
            default:
                return $this->status;
        }
    }

}
