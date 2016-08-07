<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OutSourceCom */

$this->title = 'Create Out Source Com';
$this->params['breadcrumbs'][] = ['label' => 'Out Source Coms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="out-source-com-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
