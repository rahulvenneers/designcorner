<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Shops */

$this->title = $model->brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-view">
    <div class="col-md-4">
       <?= Html::img($model->brand->logo_main);?>

   
    </div>
    <div class="col-md-8">
         <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'manager',
            'contact_no',
            'email_id:email',
            [
                'label'=>'Emirate',
                'attribute'=>'emirates.name',
            ],
            
            'store.name',
            'sqr_feet',
            //'brand_id',
           // 'latitude',
           // 'longitude',
            //'is_delete',
        ],
    ]) ?>
    </div>
    <h2>Promotions</h2>
    <table class="table table-responsive">
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    <?php
    if(!empty($model->promotionDetails)){
        foreach($model->promotionDetails as $promotion){?>
        <tr>
            <td>
                <?=$promotion->promotion->name;?>
            </td>
            <td>
                <?=$promotion->promotion->start_date;?>
            </td>
            <td>
                <?=$promotion->promotion->end_date;?>
            </td>
            <td>
                <?=$promotion->promotion->status;?>
            </td>
            <td>
            <?= Html::a('add collateral', ['/sale-pro-signages/create','pro_id'=>$promotion->promotion->id,'shop_id'=>$model->id], ['class'=>'btn btn-primary']) ?>
            </td>
        </tr>
       
    <?php }
        echo "</table>";
        }else{
            echo "</table>";
            echo "no content";
        }
    
    ?>
        
        <div class="row">
            <div class="col-sm-3">
    <h2>Signages</h2>
    <h3>sale signages</h3>
    <?php if(!empty($model->salesignages)){
     foreach($model->salesignages as $signage){
        ?>
    <div class="col-xs-3">
        <?=$signage->colType->name;?>
        H<?=$signage->height;?>
        W<?=$signage->width;?>
        <?=$signage->pro->promotion_code;?>
        <?php if($signage->status=="installed"){echo'<div class="status" style="background-color:green;"></div>';}else{echo'<div class="status" style="background-color:red;"></div>';}?>
    </div>
     <?php }}?>
    
            </div>
            <div class="col-sm-9">
     <?= Html::a('Add Main board', ['mainboard', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Main Signage</div>
                <div class="panel-body" style="max-height: 100px;overflow-y: scroll;">
             <?php
    if(!empty($model->mainboards)){
        foreach($model->mainboards as $mainboard){?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
                    <?= Html::a('Replace', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
             <?= DetailView::widget([
        'model' => $mainboard,
        'attributes' => [
            //'id',
           'height',
            'width',
           // [
           //     'label'=>'Emirate',
            //    'attribute'=>'emirates.name',
            //],
            
            'done_by',
            [
                'label'=>'Out Source name',
                'attribute'=>'out_source_name',
                'visible'=>($mainboard->out_source_name)?1:0,
                ],
            
           // 'latitude',
           // 'longitude',
            //'is_delete',
        ],
    ]) ?>
                    
    <?php
    
    
        }}  else {
    
        echo'<div class="panel-body" style="max-height: 100px;">';
        echo '<p>no main board</p>';
        echo'</div>';
        
    }?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
</div>
