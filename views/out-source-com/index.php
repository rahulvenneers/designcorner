<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OutSourceComSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Out Source Coms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="out-source-com-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Out Source Com', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'address_line_1',
            'address_line_2',
            'emirates_id',
            // 'contact_no',
            // 'email_id:email',
            // 'website',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
