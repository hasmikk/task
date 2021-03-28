<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchStudent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Modal::widget([
    'id' => 'send-mail',
    'size' => Modal::SIZE_LARGE,
    'toggleButton' => false,
]); ?>

<div class="student-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
            'username',
            'email:email',
            [
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::button(
                        '<span class="glyphicon glyphicon-envelope"></span>',
                        [
                            'class' => 'btn btn-link send-email',
                            'data-toggle' => 'modal',
                            'data-target' => '#send-mail',
                            'data-id' => $model->id

                        ]

                    );

                }

            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function(){
    
    // Show send mail form 
   $('.send-email').click(function() {
    let id = $(this).data('id'); 
   $.ajax({
    type: 'GET',
    url: '/dashboard/student/send-mail?id='+id,
    data: {id: id},
    success: function (data) {
        $('#send-mail .modal-body').html(data.html);
    }
        })
   }); 
   
   // If template is changed, fill in subject and body fields 
   $('.wrap').on('change', '.mail-template',  function(e) {
        let templateId = $(this).val(); 
        if(templateId.length){
            $.ajax({
            type: 'GET',
            url: '/dashboard/email-template/get-data',
            data: {id: templateId},
            success: function (data) {
               $('.wrap').find($('#subject')).val(data.subject); 
               $('.wrap').find($('#body')).val(data.body); 
            }
                })
        }else {
             $('.wrap').find($('#subject')).val(''); 
             $('.wrap').find($('#body')).val(''); 
        }
   })
   
   // End document ready 
});

JS;
$this->registerJs($script, \yii\web\View::POS_END);

?>
