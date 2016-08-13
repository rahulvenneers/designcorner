<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SaleProSignages */

$this->title = 'Update Sale Pro Signages: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Pro Signages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-pro-signages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
