<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['student/reset-password', 'id' => $model->id],
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true])->label("New Password") ?>
        </div>
        <div class="clol-md-3">
            <div class="form-group">
                <?= Html::submitButton('Reset', ['class' => 'btn btn-primary reset']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
