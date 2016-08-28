<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Shops */
use app\assets\ShopAsset;
ShopAsset::register($this);
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
        foreach($model->promotionDetails as $promotion){
            if($promotion->promotion){?>
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
       
       
            <?php }}
        echo "</table>";
        }else{
            echo "</table>";
            echo "no content";
        }
    
    ?>
        
        <div class="row">
            <div class="col-sm-3">
    <h2>Signages</h2>
   
     <?php if(!empty($model->salesignages)){?>
       
                <table class="table">
                    <tr  >
                        
                        <?php foreach($model->salesignages as $signage){
                            if($signage->pro->status=="ongoing"){
                        ?>
                        <td >
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal<?=$signage->id?>">
                                      image
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="myModal<?=$signage->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Design</h4>
                                          </div>
                                          <div class="modal-body">
                                            <?= Html::img($signage->design) ?>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                </li>
                                <li class="list-group-item"><?=$signage->colType->name;?></li>
                                <li class="list-group-item">H<?=$signage->height;?></li>
                                <li class="list-group-item">W<?=$signage->width;?></li>
                                <li class="list-group-item"><?=$signage->doneBy->name;?></li>
                                <li class="list-group-item"><?php if($signage->status=="installed"){echo'<div class="status" style="background-color:green;"></div>';}else{echo'<div class="status" style="background-color:red;"></div>';}?></li>
                            </ul>
                        </td>
                            <?php } }?>
                </tr>
                </table>
          
        <?php }?>
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
