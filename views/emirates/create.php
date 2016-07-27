<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Emirates */

$this->title = 'Create Emirates';
$this->params['breadcrumbs'][] = ['label' => 'Emirates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emirates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
