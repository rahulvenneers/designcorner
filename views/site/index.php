<?php
use yii\bootstrap\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="row">
        <div class="col-xs-6 home-page-btn">
            <?= Html::a('promotions', ['/promotions/index'], ['class'=>'home-menu']) ?>
        </div>
        <div class="col-xs-6 home-page-btn">
            <?= Html::a('signages', ['/emirates/index'], ['class'=>'home-menu']) ?>
        </div>
    </div>
    

    

</div>
