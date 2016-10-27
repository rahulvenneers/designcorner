<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii2mod\bxslider\BxSlider;
/* @var $this yii\web\View */
/* @var $model app\models\Shops */
use app\assets\ShopAsset;
ShopAsset::register($this);
$this->title = $model->brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="row shops-view">
    <div class="col-sm-3 logo ">
       <?= Html::img($model->brand->logo_main);?>

   
    </div>
    <div class="col-sm-9 details ">
        <div class="btn-group pull-right">
        <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                
                <li><?= Html::a('Update', ['update', 'id' => $model->id] ) ?></li> 
                <li><?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?></li>
            </ul>
        </div>
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
    <div class="col-xs-4 category" >
       <?php if($model->shopcategory){
                  foreach ($model->shopcategory as $category){echo Html::img($category->category->logo);}}?>

   
    </div>
</div>
</div>
<div class="shop-details">
    <div class="container">
<div class="row">
    <h2 class="col-md-12">Promotions</h2>
    <table class="table ">
        <tr>
            
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Days to go</th>
            <th>Status</th>
        </tr>
    <?php
    if(!empty($model->promotionDetails)){
        foreach($model->promotionDetails as $promotion){
            if($promotion->promotion){?>
        <tr>
            
            
            <td style="background-color: #FF8B17;">
                <?=$promotion->promotion->name;?>
            </td>
            <td>
                <?=$promotion->promotion->start_date;?>
            </td>
            <td>
                <?=$promotion->promotion->end_date;?>
            </td>
            <td>
                <?php
               $date=  strtotime(date('Y-m-d'));
                $endDate=  strtotime($promotion->promotion->end_date);
                echo $day=($endDate-$date)/86400;
                ?>
            </td>
            <td>
                <?=$promotion->promotion->status;?>
            </td>
            <td>
            <?= Html::a('add collateral', ['/sale-pro-signages/create','pro_id'=>$promotion->promotion->id,'shop_id'=>$model->id], ['class'=>'btn btn-primary']) ?>
            </td>
        </tr>
       
       
            <?php }}?>
       
        <?php}else{?>
            
       
       <?php }?>
    </table>
</div>
</div>

<div class="row ">
    <div class="container">       
    <h2>Signages</h2>
    <div class="col-sm-3">Sale or promotion</div>
    <div class="col-sm-9">
                <div class="btn-group pull-right">
        <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" >
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </button>
         <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             
             <li><?= Html::a('Add Main board', ['mainboard', 'id' => $model->id]) ?></li>
             <li><?= Html::a('Add Collateral', ['addcol', 'id' => $model->id]) ?></li> 
                </ul>
                </div>
               </div>
     <?php if(!empty($model->salesignages)){?>
       
               
    <div class="row">
                        <?php foreach($model->salesignages as $signage){
                            if($signage->pro->status=="ongoing"){
                        ?>
                        <div class="col-sm-3">
                        
                            <ul class="list-group">
                                <li class="list-group-item center">
                                    <!-- Button trigger modal -->
                                    <a type="button"  data-toggle="modal" data-target="#myModal<?=$signage->id?>">
                                      <?= Html::img($signage->design,['class'=>'col-img']) ?>
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="myModal<?=$signage->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Design</h4>
                                          </div>
                                          <div class="modal-body">
                                            <?= Html::img($signage->design,['class'=>'img img-responsive']) ?>
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
                                <li class="list-group-item" style="height:40px;"><?=Html::a('<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true" ></span>',['/sale-pro-signages/update','id'=>$signage->id])?></li>
                            </ul>
                        
                            <?php } ?>
                           </div>
                                <?php }?>
    </div>
    </div>       
        <?php }?>
  
            
    <div class="container">    
    <div class="row">
        <div class="col-sm-4">
            
                Main Signage
                
             <?php
    if(!empty($model->mainboards)){
        foreach($model->mainboards as $mainboard){?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
                   
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
    
       
        echo '<p>no main board</p>';
       
        
    }?>
             
        </div>
    </div>   
    </div>
    <div class="container">
            <h3>Shop collaterals</h3>
            <div class="row">
            <?php if($model->shopcol) {
            foreach ($model->shopcol as $collateral){?>
                <div class="col-md-3">
                    <li class="list-group-item"><?= Html::img($collateral->design,['class'=>'img img-responsive col-img']);?></li>
                    <li class="list-group-item"><?=$collateral->colType->name;?></li>
                    <li class="list-group-item">H<?=$collateral->height;?></li>
                    <li class="list-group-item">W<?=$collateral->width;?></li>
                    <li class="list-group-item"><?=$collateral->doneBy->name;?></li>
                </div>
           <?php }
            }?>
            </div>
        </div>

    <div class="container">
            <h3>joint collateral</h3>
            <div class="row">
             <?php if($model->joincol) {
            foreach ($model->joincol as $collateral){
                
                ?>
                <div class="col-xs-6 col-md-4 col-lg-3 center">
                 <li class="list-group-item"><?= Html::img($collateral->jointCol->design,['class'=>'img img-responsive col-img']);?></li>   
                <li class="list-group-item"><?=$collateral->jointCol->height;?></li>
                <li class="list-group-item scrolls"  ><div class="items"><?php  foreach ($collateral->jointCol->jointColDetails as $part ){?>
                            
                    <?= Html::img($part->shop->brand->logo,['class'=>'slide']);?>
                
            <?php }?>
                        </div></li></div>
            <?php    }
            }?>
            </div>
                </div>
</div>