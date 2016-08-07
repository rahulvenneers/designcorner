<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\EmiratesAsset;
EmiratesAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmirartesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emirates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emirates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
    <?php
    foreach($model as $emirate){
       ?> 
        <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
            <div class="emirate-name"><a data-toggle="collapse" href="#collapse<?=$emirate->id?>"><?= $emirate->name; ?></a></div>
        </h4>
      </div>
      <div id="collapse<?=$emirate->id?>" class="panel-collapse collapse">
        <div class="panel-body"><?php $emirate->stores;
        if(!empty($emirate->stores)){    
        foreach ($emirate->stores as $store)
            {
                echo '<div class="store-name"><p>'.$store->name.'</p></div>';
                    echo '<div class="row">';
                    foreach ($store->shops as $shop){
                        $details='<div class="shop" style="background-color:'.$shop->brand->color_code.'"><div class="brand-name">'.$shop->brand->name.'</div><div class="shop-contact">'.$shop->contact_no.'</div></div>';
                       echo Html::a($details, ['/shops/view','id'=>$shop->id], ['class'=>'col-md-2 shops']);

                    }
                    echo '</div>';
                    echo '<br>';
                    
            }
        }
        else{
            echo "No stores Added";
        }
                ?></div>
        
      </div>
    </div>
  </div>
        
   <?php }
    ?>
        </div>
</div>
