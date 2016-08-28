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
        <?= Html::a('create join col', ['createjoincol', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>
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
             <td>
                <?=$this->context->dayleft($model->id);?>
            </td>
            <td>
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
    
    <div class="row">
    <?php foreach($shops as $shop){?>
        <div class="col-md-6">
            <div class="shop-detail">
                <img src="<?= $shop->shop->brand->logo?>" class="img img-responsive">
                <?=$shop->shop->store->name;?>
            </div>
            <div>
                <?php foreach($shop->shop->salesignages as $signage){
                    if($signage->pro_id==$model->id){
                    echo '<div class="col-md-3">'.$signage->colType->name.'<br>';
                    echo $signage->height.'<br>';
                    echo $signage->width.'<br>';
                    echo $signage->pro->promotion_code.'</div>';
                }}
?>
            </div>
        </div>
    <?php }?>
        
    </div>
    <div style="background-color: grey;padding: 10px;">
        <h3>Join Collateral</h3>
        <?php foreach ($model->joincol as $join) {
            echo $join->job_order;echo Html::a('update',array('/promotions/updatejoincol','id'=>$join->id)).'<br>';
            foreach ($join->jointColDetails as $joinCol){
            echo '<div style="display:inline;position:relative;">';
                
               echo Html::img($joinCol->shop->brand->logo, ['alt'=>$joinCol->shop->store->name, 'class'=>'thing', 'data-toggle'=>'tooltip','data-placement'=>'left','title' => $joinCol->shop->store->name ,'style'=>'cursor:default;']);
               echo '<div style="position:absolute;top: -16px; right:0px; z-index:10;">';
               echo Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',array('/promotions/deletejoinshop','id'=>$joinCol->id));
               echo '</div>';
            echo '</div>';    
                
            }
            echo '<br>';
    } ?>
        
    </div>
</div>  
   