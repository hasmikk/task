<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\dashboard\models\MailQueue */

$this->title = 'Update Mail Queue: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mail Queues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mail-queue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
