<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaleProSignages */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sale Pro Signages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-pro-signages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'job_order',
            'col_type_id',
            'height',
            'width',
            'nos',
            'design',
            'pro_id',
            'shop_id',
            'install_date',
            'removal_date',
            'status',
        ],
    ]) ?>

</div>
