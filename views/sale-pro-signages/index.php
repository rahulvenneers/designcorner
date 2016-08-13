<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SaleProSignagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sale Pro Signages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-pro-signages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sale Pro Signages', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'job_order',
            'col_type_id',
            'height',
            'width',
            // 'nos',
            // 'design',
            // 'pro_id',
            // 'shop_id',
            // 'install_date',
            // 'removal_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
