<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\dashboard\models\search\SearchEmailTemplate */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'subject',
            'body:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>


</div>
