<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OutSourceCom */

$this->title = 'Update Out Source Com: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Out Source Coms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="out-source-com-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
