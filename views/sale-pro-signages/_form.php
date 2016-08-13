<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaleProSignages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-pro-signages-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal',['enctype' => 'multipart/form-data']],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md-2\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-2 control-label'],
        ],
        
        ]); ?>

    <?= $form->field($model, 'job_order')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col_type_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\CollateralType::find()->all(),'id','name'),['prompt'=>'select collateral type']) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    
    <?= $form->field($model,'done_by')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\OutSourceCom::find()->all(),'id','name'));?>

    <?= $form->field($model, 'status')->dropDownList([ 'not_installed' => 'Not installed', 'installed' => 'Installed', 'removed' => 'Removed', ], ['prompt' => '']) ?>

    <div class=" form-group">
        <div class="col-md-offset-2 col-md-10">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
