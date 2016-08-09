<?php

namespace app\controllers;

use Yii;
use app\models\Promotions;
use app\models\PromotionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PromotionsController implements the CRUD actions for Promotions model.
 */
class PromotionsController extends Controller
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
     * Lists all Promotions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromotionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promotions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
      
        $shops=$model->shops;
        return $this->render('view', [
            'model' => $model,'shops'=>$shops
        ]);
    }

    /**
     * Creates a new Promotions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Promotions();
        $imageName=trim($model->name);
         if ($model->load(Yii::$app->request->post()) ) {
              if($model->permission = UploadedFile::getInstance($model, 'permission')){
                $model->permission_letter='uploads/permission/'.$imageName.'.'.$model->permission->extension;
                $model->permission->saveAs('uploads/permission/'.$imageName.'.'.$model->permission->extension);
              }
              if($model->save()){
                  if(isset($_POST['promotion']))
                    {
                    
                    foreach ($_POST['promotion'] as $shop)
                        {
                            $details=new \app\models\PromotionDetails();
                            $details->promotion_id=$model->id;
                            $details->shop_id=$shop;
                            $details->save();
                        }
                    }
              return $this->redirect(['view', 'id' => $model->id]);
              }
              
             //if($model->save()){
                 
                 //   
               // }   
            }
         else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
       
                
    }

    /**
     * Updates an existing Promotions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageName=trim($model->name);
         if ($model->load(Yii::$app->request->post()) ) {
            if($model->permission = UploadedFile::getInstance($model, 'permission')){
                $model->permission_letter='uploads/permission/'.$imageName.'.'.$model->permission->extension;
                $model->permission->saveAs('uploads/permission/'.$imageName.'.'.$model->permission->extension);
            }
              
             if($model->save()){
                 
                    return $this->redirect(['view', 'id' => $model->id]);
                }   
         } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Promotions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Promotions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promotions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promotions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
