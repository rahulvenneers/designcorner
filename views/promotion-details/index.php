<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromotionDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotion Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Promotion Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'promotion_id',
            'shop_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
