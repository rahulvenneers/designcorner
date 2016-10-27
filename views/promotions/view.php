<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\PromotionAsset;
use yii\helpers\Url;
PromotionAsset::register($this);       
/* @var $this yii\web\View */
/* @var $model app\models\Promotions */
?>
<div class="container">
<?php
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-8">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>

<div class="col-xs-4 ">
     <div class="btn-group pull-right">
        <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </button>
         <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <li><?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'dropdown-item']) ?></li>
             <li><?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'dropdown-item',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?></li>
             <li><?= Html::a('create join col', ['createjoincol', 'id' => $model->id], ['class' => 'dropdown-item']) ?></li>
    </ul>
  </div>
</div>
</div>

    <table class="table">
        <tr style="text-align: center">
            <th>
                
            </th>
            <th>
                Ref. No.
            </th>
            <th>
                Emirate
            </th>
            <th>
                Start
            </th>
            
            <th>
                End
            </th>
            <th>
                day left
            </th>
            <th>
                Total Days
            </th>
            <th>
                Permission
            </th>
            <th>
                status
            </th>
            
        </tr>
        <tr style="color: white">
            <td style="background-color: #FF8B17">
                <?=$model->name;?>
            </td>
            <td style="color:#282828">
                <?=$model->promotion_code;?>
            </td>
            <td style="color:#282828">
                <?=$model->emirates->name;?>
            </td>
            <td style="background-color: #282828">
                <?=$model->start_date;?>
            </td>
           
            <td style="background-color: #282828">
                <?=$model->end_date;?>
            </td>
             <td style="color:#282828">
                <?=$this->context->dayleft($model->id);?>
            </td>
            <td style="color:#282828">
                <?=$this->context->totaldays($model->id);?>
            </td>
            <td>
                <a  href="index.php?r=promotions/download&id=<?=$model->id?>"  target="helperFrame" ><span class="glyphicon glyphicon-save" aria-hidden="true"></span></a>
               
            </td>
            <td style="background-color: #FF8B17">
                <?=$model->status;?>
            </td>
        </tr>
    </table>
    <div class=" row pro-details">
        <h3>Description</h3>
        <?=$model->discription?>
    </div>
    <div class="row">
        <h4>Jointed Stores</h4>
    <?php foreach($shops as $shop){?>
        <div class="col-sm-4">
            <div class="shop-detail" >
                <a href="<?= Url::to(['shops/view','id'=>$shop->shop->id])?>"><img style="vertical-align:middle" src="<?= $shop->shop->brand->logo?>" class="img img-responsive" ></a>
                <span ><?=$shop->shop->store->name;?></span>
            </div>
          
        </div>
    <?php }?>
        
    </div>
<div style="background-color:grey;padding: 10px;position: static; margin-top: 50px;" class="row">
        <h3>Join Collateral</h3>
        <?php foreach ($model->joincol as $join) {
             echo '<div class="col-sm-4" >';
            ?>
        <ul style="margin-left:-40px;">
                <li class="list-group-item" style="height: 100px;"><a data-toggle="modal" href="#myModal<?=$join->id?>"><img id="imageresource" src="<?=$join->design?>" class="img img-responsive" alt="Trolltunga, Norway" style="height: 100px;text-align: center;margin: 0 auto;" ></a></li>
                    <li class="list-group-item"><?=$join->colType->name;?></li>
                    <li class="list-group-item">Height:<?=$join->height;?></li>
                    <li class="list-group-item">Width:<?=$join->width;?></li>
                    <li class="list-group-item">Company:<?=$join->doneBy->name;?></li>
                    <li class="list-group-item" style="height: 40px;"><?php if($join->status=="installed"){echo'<div class="status" style="background-color:green;"></div>';}else{echo'<div class="status" style="background-color:red;"></div>';}?><?php echo'<div style="margin-top:-20px;text-align:center" >';?><a data-toggle="modal" href="#myModalLoc<?=$join->id?>"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></a></div><?php echo'<div style="margin-top:-20px;" >';?><?=Html::a('<span class="glyphicon glyphicon-pencil pull-right" aria-hidden="true"></span>',['/promotions/updatejoincol','id'=>$join->id]);?></div></li>
                    
            </ul>
     
            <?php
           
            if($join->jointColDetails){
                
            foreach ($join->jointColDetails as $joinCol){
            echo '<div class="shop-button" style="display:inline;position:relative;">';
               
               echo Html::img($joinCol->shop->brand->logo, ['alt'=>$joinCol->shop->store->name, 'class'=>'thing', 'data-toggle'=>'tooltip','data-placement'=>'left','title' => $joinCol->shop->store->name ,'style'=>'cursor:default; ']);
               
               echo '<div class="shop-remove" >';
               echo Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',['/promotions/deletejoinshop','id'=>$joinCol->id],['data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                
            ]]);
               echo '</div>';
            echo '</div>';    
                
            }
            
            }
            else{
                echo '<div style="height:50px;"></div>';
            }
            echo '</div>';?>
        <div class="modal fade" id="myModal<?=$join->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
  <div >
    
    <div class="modal-body">
        <img class="img-responsive" src="<?=$join->design?>" alt="image" />
    </div>
   
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 </div><!-- /.modal --> 
 
 <div class="modal fade" id="myModalLoc<?=$join->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
  <div >
    
    <div class="modal-body">
        <img class="img-responsive" src="<?=$join->loc_image?>" alt="image" />
    </div>
   
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 </div><!-- /.modal --> 

    <?php } ?>
        
    </div>
  
</div>
