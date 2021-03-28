<?php

use backend\modules\dashboard\models\MailQueue;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\dashboard\models\search\SearchMailQueue */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Queued Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-queue-index">

    <h3><?= $this->title ?></h3>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'to',
            'subject',
            [
                'attribute' => 'body',
                'contentOptions' => ['style' => 'text-align:center; width:45%;'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->statusLabel;
                },
                'filter' => MailQueue::getStatusDropDown(),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function ($model) {
                    return date("Y-m-d G:i:s", $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->updated_at) {
                        return date("Y-m-d G:i:s", $model->updated_at);
                    }
                }
            ],
        ],
    ]); ?>


</div>
