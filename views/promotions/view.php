<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Promotions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotions-view">

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
        <?= Html::a('Add shops', ['promotion-details/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'promotion_code',
            'name',
            'discription:ntext',
            'start_date',
            'end_date',
            'emirates.name',
            
            [
              'format'=>'image',
              'attribute'=>'permission_letter',
            ],
            //'permission_letter',
            'status',
        ],
    ]) ?>
    <div class="row">
    <?php foreach($shops as $shop){?>
        <div class="col-md-4">
            <img src="<?= $shop->shop->brand->logo?>" class="img img-thumbnail"><br>
            <?=$shop->shop->brand->name;?>
        </div>
    <?php }?>
</div>
