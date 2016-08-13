<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SaleProSignages */

$this->title = 'Create Sale Pro Signages';
$this->params['breadcrumbs'][] = ['label' => 'Sale Pro Signages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-pro-signages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
