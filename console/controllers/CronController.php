<?php

namespace console\controllers;

use backend\modules\dashboard\models\EmailAccount;
use backend\modules\dashboard\models\MailQueue;
use yii\console\Controller;

class CronController extends Controller
{

    /**
     * Send emails
     */

    public function actionSendMail()
    {
        MailQueue::sendFromQueue();
    }

}