<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PromotionDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promotion-details-form">

    <?php $form = ActiveForm::begin(); ?>

   

   <?= $form->field($model, 'shop_id')->checkboxList(yii\helpers\ArrayHelper::map(\app\models\Shops::find()->All(), 'id', 'brand.name'))  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
