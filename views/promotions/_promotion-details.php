<?php
use yii\bootstrap\Html;
use app\assets\PromotionAsset;
PromotionAsset::register($this);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$details= $model->promotionDetails;
echo '<div class="row">';
foreach($details as $detail)
{
    echo '<div class="col-md-2 shop-detail">';
    echo '<div class="brand-logo">'.Html::img($detail->shop->brand->logo).'</div>';
    echo '<div class="store-name">'.$detail->shop->store->name.'</div>';
    echo '</div>';
}
echo '</div>';
?>
