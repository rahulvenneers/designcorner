<?php

namespace app\controllers;

use Yii;
use app\models\Emirates;
use app\models\EmirartesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmiratesController implements the CRUD actions for Emirates model.
 */
class EmiratesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Emirates models.
     * @return mixed
     */
    public function actionIndex()
    {
       $model= Emirates::find()->all();
       $brands=  \app\models\Brands::find()->all();

        return $this->render('index', [
            'model' => $model,'brands'=>$brands,
        ]);
    }

    /**
     * Displays a single Emirates model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Emirates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    /**
     * Updates an existing Emirates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionStore($id) {
        $emirate = $this->findModel($id);
        $stores=$emirate->stores;
        echo'<div class="row">';
        foreach($stores as $store){
            echo '<div class="store">';
            echo'<div class="store-name">'.$store->name.'</div>';
            echo '<div class="row">';
            foreach($store->shops as $shop){
                echo '<a href="index.php?r=shops/view&id='.$shop->id.'" ><div class="col-md-2 '.$shop->brand->class.' shop btn" style="background-color:'.$shop->brand->color_code.'">'.$shop->brand->name.'</div></a>';
            }
            echo'</div>';
            echo '</div>';
        }
        echo '</div>';
    }
    /**
     * Deletes an existing Emirates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    

    /**
     * Finds the Emirates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emirates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emirates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
