<?php

?>
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
    <?php if(isset($_GET['album'])){
    echo $_GET['album'];
} ?>


    <div class="row seven-cols">
    <?php
    foreach($model as $emirate){
       ?> 
        <div class="col-md-1"><button class="emirate-name" value="<?=$emirate->id;?>"><?= $emirate->name; ?></button></div>
        
   <?php }
    ?>
        </div>
    <div class="row">
        <div class=" brands">
        <?php
    foreach($brands as $brand){
       ?> 
            <button class="btn active brand-name" value="<?=$brand->id?>"><?=$brand->name; ?></button>
        
   <?php }
    ?>
        </div>
    </div>
        
        <div id="store-details"></div>
        
 
 </div>

