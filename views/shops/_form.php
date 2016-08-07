<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Shops */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emirates_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Emirates::find()->all(),'id','name'),
        [
                'prompt'=>'Select Emirates',
                'onChange'=>'
                    $.post( "index.php?r=stores/list&id='.'"+$(this).val(),function( data ){
                    $( "select#shops-store_id" ).html( data );
                });'
            ]); ?>


    <?= $form->field($model, 'store_id')->dropDownList(['prompt'=>'Select Store']);?>

    <?= $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Brands::find()->all(),'id','name')) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


