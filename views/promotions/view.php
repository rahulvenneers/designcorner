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
        <?= Html::a('Add shops', ['promotion-details/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                day left
            </th>
            <th>
                End
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
        <tr >
            <td>
                <?=$model->name;?>
            </td>
            <td>
                <?=$model->promotion_code;?>
            </td>
            <td>
                <?=$model->emirates->name;?>
            </td>
            <td>
                <?=$model->start_date;?>
            </td>
            <td>
                <?=$this->context->dayleft($model->id);?>
            </td>
            <td>
                <?=$model->end_date;?>
            </td>
            <td>
                <?=$this->context->totaldays($model->id);?>
            </td>
            <td>
                <a  href="index.php?r=promotions/download&id=<?=$model->id?>"  target="helperFrame" ><span class="glyphicon glyphicon-save" aria-hidden="true"></span></a>
               
            </td>
            <td>
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
                    echo '<div class="col-md-3">'.$signage->colType->name.'<br>';
                    echo $signage->height.'<br>';
                    echo $signage->width.'<br>';
                    echo $signage->pro->promotion_code.'</div>';
                }
?>
            </div>
        </div>
    <?php }?>
</div>
   