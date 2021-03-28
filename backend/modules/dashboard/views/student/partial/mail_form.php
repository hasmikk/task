<?php

use backend\modules\dashboard\models\EmailTemplate;
use yii\helpers\Html;

?>

<?= Html::beginForm(['student/send-mail', 'id' => $model->id], 'POST'); ?>
<div class="row">
    <div class="form-group col-md-6">
        <?= Html::dropDownList('template_id', '', EmailTemplate::dropDownList(), ['class' => 'form-control mail-template', 'prompt' => '- Choose Template -'])
        ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <b>Email</b>
        <?= Html::textInput('email', $model->email, ['class' => 'form-control']) ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <b>Subject</b>
        <?= Html::textInput('subject', '', ['class' => 'form-control', 'id'=>'subject']) ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-10">
        <b>Body</b>
        <?= Html::textarea('body', '', ['rows' => 7, 'class' => 'form-control', 'id'=>'body']) ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-11">
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary pull-right']); ?>
    </div>
</div>
<?= Html::endForm(); ?>
</div>
