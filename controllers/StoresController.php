<?php

namespace app\controllers;

use Yii;
use app\models\Stores;
use app\models\StoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoresController implements the CRUD actions for Stores model.
 */
class StoresController extends Controller
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
     * Lists all Stores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stores model.
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
     * Creates a new Stores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stores model.
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

    /**
     * Deletes an existing Stores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->is_deleted="yes";
        $model->save();
        return $this->redirect(['index']);
    }
    
    
    public function actionList($id){
        $countStores=  Stores::find()
                ->where(['emirates_id'=>$id])
                ->count();
        $stores=Stores::find()
                ->where(['emirates_id'=>$id])
                ->all();
        if($countStores>0){
            echo "<option>SELECT STORE</option>";
            foreach ($stores as $store){
                echo '<option value='.$store->id.'>'.$store->name.'</option>';
            }
        }
        else{
            echo "<option>SELECT STORE</option>";
            echo "<option>no store found</option>";
        }
    }
    public function actionListprom($id){
        $countStores=  Stores::find()
                ->where(['emirates_id'=>$id])
                ->count();
        $stores=Stores::find()
                ->where(['emirates_id'=>$id])
                ->all();
        if($countStores>0){
            
            foreach ($stores as $store){
                echo '<div class="store-name">'.$store->name.'</div>';
               //$form->field($model, 'shop_id')->checkboxList(yii\helpers\ArrayHelper::map(\app\models\Shops::find()->All(), 'id', 'brand.name'));
                if(!empty($store->shops))
                {
                    
                    foreach ($store->shops as $shop){
                       echo '<div class="checkbox-group"><input type="checkbox" class="checkbox" id="checkbox'.$shop->id.'" name="promotion[]" value='.$shop->id.'><label for="checkbox'.$shop->id.'" class="checkbox-label">'.$shop->brand->name.'</label></div>';
                    }
                }
                
            }
        }
        
    }
    

    /**
     * Finds the Stores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
