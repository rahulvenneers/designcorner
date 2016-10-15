<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\JointCollateral */
/* @var $form ActiveForm */
?>
<div class="promotions-_formJoin container" style="margin-top: 100px;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'job_order')->textInput() ?>
        <?= $form->field($model, 'col_type_id')->dropDownList(ArrayHelper::map(app\models\CollateralType::find()->all(),'id','name'),['prompt'=>'select collateral type']) ?>
        <?= $form->field($model, 'height')->textInput() ?>
        <?= $form->field($model, 'width')->textInput() ?>
        <?= $form->field($model, 'nos')->textInput() ?>
        <?= $form->field($model, 'designImage')->fileInput() ?>
        <?= $form->field($model, 'locationImage')->fileInput()?>
        <?= $form->field($model, 'done_by')->dropDownList(ArrayHelper::map(app\models\OutSourceCom::find()->all(),'id','name'),['prompt'=>'select Company']) ?>
       
        <?= $form->field($model, 'status')->dropDownList([ 'not_installed' => 'Not installed', 'installed' => 'Installed', 'removed' => 'Removed', ], ['prompt' => 'select status']) ?>
       
        <?php foreach($shops as $shop) {?>
    <input type="checkbox" name="shop[]" value="<?=$shop->shop->id;?>"><?=$shop->shop->brand->name.'-'.$shop->shop->store->name;?><br>
        <?php }?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- promotions-_formJoin -->
