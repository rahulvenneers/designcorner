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
                                        
            [
                'attribute'=>'promotion_code',
                'options' => [ 'style' =>'background-color:#FF8B17;width:10%'],
            ],                          
            [
                'attribute'=> 'name', 
                'options' => [ 'style' =>'background-color:#EAEAEA;width:10%'],
            ],
            
            //'discription:ntext',
            [
                'attribute' => 'start_date',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Enter date ...'], //this code not giving any changes in browser
                    'type' =>  \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
//
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-dd'
                    ],
                ],
               'options' => [ 'style' =>'background-color:#D1D1D1;width:20%;'], 
            ],
            
             [
                'attribute' => 'end_date',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Enter date ...'], //this code not giving any changes in browser
                    'type' =>  \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
//
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-dd'
                    ],
                ],
                 'options' => [ 'style' =>'background-color:#D1D1D1;width:20%;'],
            ],
            [
                'attribute' => 'days to go',
                'format' => 'raw',
                'value' => function ($model) { 
                $date=  strtotime(date('Y-m-d'));
                $endDate=  strtotime($model->end_date);
                if($date<$endDate)
                {
                    $color="";
                    $day=($endDate-$date)/86400;
                    if($day<3){
                       $color="red";
                    }
                    else if($day<7)
                    {
                        $color="orange";
                    }
                    
                    return '<div style="background-color:'.$color.';text-align:center">'.$day.'</div>';
                }
                else{
                    return '<div style="text-align:center">ended</div>';
                }
                
            },
            'options' => [ 'style' =>'text-align:center'],
            ],
            [
              'attribute'=>'emirates_id',
               'value'=>'emirates.name',
                'filter' => [ 'Dubai' => 'Dubai', 'Sharjah' => 'Sharjah',],
            
            ],
            
             
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute'=>'status',
                'options' => [ 'style' =>'background-color:#FF8B17;width:10%;'],           
                'pageSummary' => true,
                'editableOptions'=> [
                    'header' => 'profile',
                    'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data'=> ['ongoing'=>'ongoing','ended'=>'ended'],
       
                 ],
           'filter' => [ 'Ongoing' => 'ongoing', 'Ended' => 'ended',]
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} ']

            
        ],
    ]); ?>
</div>
