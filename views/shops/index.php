<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Shops', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
               'attribute'=>'brand_id',
                'value'=>'brand.name',
            ],
            'contact_no',
            'email_id:email',
            [
              'attribute'=>'emirates_id', 
               'value'=>'emirates.name',
            ],
            [
                'attribute'=>'store_id',
                'value'=>'store.name',
            ],
            
            
             
            // 'latitude',
            // 'longitude',
            // 'is_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
