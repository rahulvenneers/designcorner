<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/js/outsource.js');


/* @var $this yii\web\View */
/* @var $model app\models\MainBoards */
/* @var $form ActiveForm */
$this->title = 'main board';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $shop->brand->name , 'url' => ['view','id'=>$shop->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Add your main board details</h3>
<div class="shops-mainboard">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model,'job_order')->textInput()?>
        <?= $form->field($model, 'width')->textInput() ?>
        <?= $form->field($model, 'height')->textInput() ?>
        <?= $form->field($model, 'done_by')->dropDownList([ 'in_house' => 'In house', 'out_source' => 'Out source', ], ['prompt' => 'Select Status']) ?>
        <?= $form->field($model, 'out_source_name')->textInput() ?>
        <?= $form->field($model, 'board')->fileInput() ?>
        
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- shops-mainboard -->
<?

?>