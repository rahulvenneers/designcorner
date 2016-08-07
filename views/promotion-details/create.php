<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PromotionDetails */

$this->title = 'Create Promotion Details';
$this->params['breadcrumbs'][] = ['label' => 'Promotion Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
