<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use app\assets\CheckboxAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Promotions */
/* @var $form yii\widgets\ActiveForm */
CheckboxAsset::register($this);
?>

<div class="promotions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'promotion_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discription')->textarea(['rows' => 6]) ?>
    <label>Start Date</label>
    <?= DatePicker::widget([
    'model'=>$model,
        'attribute' => 'start_date', 
    
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    <?= Html::error($model, 'start_date') ?>
<label>End Date</label>
    <?= DatePicker::widget([
    'model'=>$model,
        'attribute' => 'end_date', 
    
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-m-dd',
        'todayHighlight' => true,
        'clearButton' => false,
    ]
]);?>
<?= Html::error($model, 'end_date') ?>
    <?= $form->field($model, 'emirates_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Emirates::find()->all(),'id','name'),
        [
                'prompt'=>'Select Emirates',
                'onChange'=>'
                     var value=$(this).val();
                     if(value!=""){$(\'.store\').show();}else{$(\'.store\').hide();}
                    $.post( "index.php?r=stores/listpromotion&id='.'"+$(this).val(),function( data ){
                     
                    $( "#store.store" ).html( data );
                });' 
            ]); ?>
 
<div class="store" id="store"></div>
    <?= $form->field($model, 'store_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Stores::find()->all(),'id','name'),['prompt'=>'Select Store']);?>


    <?= $form->field($model, 'permission')->fileInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approved', 'ongoing' => 'Ongoing', 'ended' => 'Ended', 'not_approved' => 'Not approved', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



</div>
