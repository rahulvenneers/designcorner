<?php

namespace app\controllers;

use Yii;
use app\models\Shops;
use app\models\ShopsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\MainBoards;

/**
 * ShopsController implements the CRUD actions for Shops model.
 */
class ShopsController extends Controller
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
     * Lists all Shops models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shops model.
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
     * Creates a new Shops model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shops();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionAddcol($id){
        $model=new \app\models\ShopCollaterals();
        $model->shop_id=$id;
        if ($model->load(Yii::$app->request->post())) {
            if($model->locationImage = UploadedFile::getInstance($model, 'locationImage')){
                $model->location='uploads/join/loc/'.$imageName.'.'.$model->locationImage->extension;
                $model->locationImage->saveAs('uploads/join/loc/'.$imageName.'.'.$model->locationImage->extension);
              }
              if($model->designImage = UploadedFile::getInstance($model, 'designImage')){
                $model->design='uploads/join/img/'.$imageName.'.'.$model->designImage->extension;
                $model->designImage->saveAs('uploads/join/img/'.$imageName.'.'.$model->designImage->extension);
              }
            
                
            //if($model->save()){
                return $this->redirect(['view', 'id' => $id]);
           // }
            print_r($model->getErrors());
                
        }
        else {
            return $this->render('_formcol', [
                'model' => $model
            ]);
        }
    }

    public function actionMainboard($id)
    {
        $model = new MainBoards();
        $model->shop_id=$id;
        $shop = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $imageName=$model->job_order;
            if($model->board = UploadedFile::getInstance($model, 'board'))
            {
                $model->image='uploads/signages/main-board/'.$imageName.'.'.$model->board->extension;
                $model->board->saveAs('uploads/signages/main-board/'.$imageName.'.'.$model->board->extension);
            }
            $model->board=null;
            if($model->save()){
            return $this->redirect(['view', 'id' => $model->shop_id]);
            }
            
        } else {
            return $this->render('mainboard', [
                'model' => $model,'shop'=>$shop,
            ]);
        }
    }

    /**
     * Updates an existing Shops model.
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
     * Deletes an existing Shops model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_delete="yes";        
        $model->save();
        return $this->redirect(['index']);
    }
    
   

    /**
     * Finds the Shops model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shops the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shops::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
