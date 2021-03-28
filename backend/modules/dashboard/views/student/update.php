<?php

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Update Student: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">
    <?= $this->render('_form', [
        'model' => $model,
        'create' => false
    ]) ?>

</div>
