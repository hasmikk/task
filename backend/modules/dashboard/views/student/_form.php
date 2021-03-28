<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Modal::widget([
    'id' => 'reset-modal',
    'size' => Modal::SIZE_DEFAULT,
    'toggleButton' => false,
]); ?>

    <div class="student-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <?php if ($create): ?>
                <div class="col-md-3">
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                </div>
            <?php else: ?>
                <div class="col-md-2">
                    <?= Html::a(
                        'Reset Password',
                        ['reset-password', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-warning',
                            'id' => 'reset-password',
                            'data-toggle' => 'modal',
                            'data-id' => $model->id,
                            'data-target' => '#reset-modal'
                        ]
                    ); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php
$script = <<< JS
$(document).ready(function(){
   $('#reset-password').click(function() {
    let id = $(this).data('id'); 
   $.ajax({
    type: 'GET',
    url: '/dashboard/student/reset-password?id='+id,
    data: {id: id},
    success: function (data) {
        $('#reset-modal .modal-body').html(data.html); 
    }
    })
   }); 
}); 
JS;
$this->registerJs($script, \yii\web\View::POS_END);

?>