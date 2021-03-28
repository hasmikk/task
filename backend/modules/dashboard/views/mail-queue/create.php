<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\dashboard\models\MailQueue */

$this->title = 'Create Mail Queue';
$this->params['breadcrumbs'][] = ['label' => 'Mail Queues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-queue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
