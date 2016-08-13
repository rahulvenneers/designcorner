<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PromotionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Promotions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export'=>false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\ExpandRowColumn',
              'value' => function ($model, $key, $index, $column) {
                         return GridView::ROW_COLLAPSED;
              },
                      'detail'=>function ($model, $key, $index, $column) {
                                        return Yii::$app->controller->renderPartial('_promotion-details.php', ['model'=>$model]);
                                },
                                
                    'detailOptions'=>[
                        'class'=> 'kv-state-enable',
                        ],
            ],
            
            //'id',
            'promotion_code',
            'name',
            //'discription:ntext',
            'start_date',
            'end_date',
            [
                'attribute' => 'days to go',
                'format' => 'raw',
                'value' => function ($model) { 
                $date=  strtotime(date('Y-m-d'));
                $endDate=  strtotime($model->end_date);
                if($date<$endDate)
                {
                    ;
                    $day=($endDate-$date)/86400;
                    if($day<7){
                       
                    }
                    
                    return '<div >'.$day.'</div>';
                }
                else{
                    return '<div>end</div>';
                }
                
            },
            ],
            [
              'attribute'=>'emirates_id',
               'value'=>'emirates.name',
            ],
            
             [
                    'format'=>'image',
                   'value' => function ($model) {
                    return Html::a( '<img src="'.$model->permission_letter.'">',['/typology/view', 'id' => $model->id]);
            },
            ],
            'status',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} ']

            
        ],
    ]); ?>
</div>
