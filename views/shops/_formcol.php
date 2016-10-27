<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopCollaterals */
/* @var $form ActiveForm */
?>
<div class="shops-_formcol">

    <?php $form = ActiveForm::begin(); ?>

        
        <?= $form->field($model, 'col_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CollateralType::find()->all(), 'id', 'name'),['prompt'=>'select collateral type']) ?>
        <?= $form->field($model, 'height')->textInput() ?>
        <?= $form->field($model, 'width')->textInput() ?>
        <?= $form->field($model, 'nos')->textInput() ?>
        <?= $form->field($model, 'job_order')->textInput() ?>
        <?= $form->field($model, 'done_by')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\OutSourceCom::find()->all(), 'id', 'name'),['prompt'=>'select company']) ?>
        <?= $form->field($model, 'designImage')->fileInput() ?>
        <?= $form->field($model, 'locationImage')->fileInput() ?>
     
        <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'removed' => 'Removed', ], ['prompt' => 'Select Status']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- shops-_formcol -->
