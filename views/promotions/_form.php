<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\assets\CheckboxAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Promotions */
/* @var $form ActiveForm */
CheckboxAsset::register($this);
?>
<div class="promotions-_form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'promotion_code')->textInput() ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'discription')->textarea() ?>
        <label class="control-label">Start Date</label>
        <?=  DatePicker::widget([
            'model'=>$model,
            'form'=>$form,
            'attribute' => 'start_date',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => '',
            'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-dd',
            'todayHighlight' => true,
            ]
            ]); ?>
        
         <label class="control-label">End Date</label>
        <?=  DatePicker::widget([
            'model'=>$model,
            'form'=>$form,
            'attribute' => 'end_date',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => '',
            'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-dd',
            'todayHighlight' => true,
            ]
            ]); ?>
        
       
        <?= $form->field($model, 'emirates_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Emirates::find()->all(),'id','name'),
                [
                    'prompt'=>'select emirate',
                    'onChange'=>'
                                var val=$(this).val();
                                $.ajax({  
                                    type: \'GET\',  
                                    url: \'index.php?r=stores/listprom\', 
                                    data: { id: val },
                                    success: function(response) {
                                        $("#store-details").html(response);
                                    }
                                    })'   
                    ]) ?>
     
         <div class="store-details" id="store-details"></div>
        <?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approved', 'ongoing' => 'Ongoing', 'ended' => 'Ended', 'not_approved' => 'Not approved', ], ['prompt' => 'Select Status']) ?>
        <?= $form->field($model, 'permission')->fileInput() ?>
       
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- promotions-_form -->
