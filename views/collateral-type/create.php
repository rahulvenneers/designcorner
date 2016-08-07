<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CollateralType */

$this->title = 'Create Collateral Type';
$this->params['breadcrumbs'][] = ['label' => 'Collateral Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collateral-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
