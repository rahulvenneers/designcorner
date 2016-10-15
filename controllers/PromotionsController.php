<?php

namespace app\controllers;

use Yii;
use app\models\Promotions;
use app\models\PromotionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\JointCollateral;
use yii\helpers\Json;

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
        if (Yii::$app->request->post('hasEditable')) {
            $pro_id=Yii::$app->request->post('editableKey');
            $pro=  Promotions::findOne($pro_id);
            $out=Json::encode(['output'=>'','message'=>'']);
            $post=[];
            $posted=current($_POST['Promotions']);
            $post['Promotions']=$posted;
            if($pro->load($post)){
                $pro->save();
            }
            echo $out;
            return;
        }
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
    public function actionCreatejoincol($id)
    {
        $model = new JointCollateral();
        $promotion=$this->findModel($id);
        $pro_details=$promotion->promotionDetails;
        $model->pro_id=$id;
    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
           
            // form inputs are valid, do something here
            if($model->save()){
            if(isset($_POST['shop'])){
            foreach ($_POST['shop'] as $shop)
            {
                $join= new \app\models\JointColDetails();
                $join->pro_id=$id;
                $join->shop_id=$shop;
                $join->joint_col_id=$model->id;
                $join->save();
            }
            }
            }
           return $this->redirect(['view','id'=>$id]);
        }
        
    }

    return $this->render('_formJoin', [
        'model' => $model,'shops'=>$pro_details
    ]);
        
    }
    
    
    public function actionUpdatejoincol($id)
    {
        $model = JointCollateral::findOne(['id'=>$id]);
        $promotion=$this->findModel($model->pro_id);
        $pro_details=$promotion->promotionDetails;
        $imageName=$model->job_order;
        foreach ($pro_details as $key=>$shop)
        {
            $col=  \app\models\JointColDetails::find()->where(['pro_id'=>$model->pro_id,'shop_id'=>$shop->shop->id,'joint_col_id'=>$model->id])->one();
            if(!empty($col)){
                unset($pro_details[$key]);
            }
        }
    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            
            // form inputs are valid, do something here
            if($model->save()){
                if($model->locationImage = UploadedFile::getInstance($model, 'locationImage')){
                $model->loc_image='uploads/join/'.$imageName.'.'.$model->locationImage->extension;
                $model->locationImage->saveAs('uploads/join/loc/'.$imageName.'.'.$model->locationImage->extension);
              }
              if($model->designImage = UploadedFile::getInstance($model, 'designImage')){
                $model->design='uploads/join/'.$imageName.'.'.$model->designImage->extension;
                $model->designImage->saveAs('uploads/join/img/'.$imageName.'.'.$model->designImage->extension);
              }
            if(isset($_POST['shop'])){
            foreach ($_POST['shop'] as $shop)
            {
                $join= new \app\models\JointColDetails();
                $join->pro_id=$model->pro_id;
                $join->shop_id=$shop;
                $join->joint_col_id=$model->id;
                $join->save();
            }
            }
            }
           return $this->redirect(['view','id'=>$model->pro_id]);
        }
        
    }

    return $this->render('_formJoin', [
        'model' => $model,'shops'=>$pro_details
    ]);
        
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
         } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function dayleft($id)
    {
       $model = $this->findModel($id);
       $date=  strtotime(date('Y-m-d'));
                $endDate=  strtotime($model->end_date);
                if($date<$endDate)
                {
                    ;
                    $day=($endDate-$date)/86400;
                    if($day<7){
                       
                    }
                    
                    return $day;
                }
                else{
                    return 'end';
                }
    }
    public function totaldays($id)
    {
       $model = $this->findModel($id);
       $startdate=  strtotime(date($model->start_date));
       $endDate=  strtotime($model->end_date);
                if($startdate<$endDate)
                {
                    
                    $day=($endDate-$startdate)/86400;
                    if($day<7){
                       
                    }
                    
                    return $day;
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
    public function actionDeletejoinshop($id)
    {
        $joinshop=  \app\models\JointColDetails::findOne(['id'=>$id]);
        $redirect=$joinshop->pro_id;
        $joinshop->delete();
        return $this->redirect(['view','id'=>$redirect]);
    }

    /**
     * 
     * @param type $id
     * download permission letter for the perticular id
     */
    public function actionDownload($id)
    {
        $model = $this->findModel($id);
        if (file_exists($model->permission_letter)) {

            Yii::$app->response->sendFile($model->permission_letter);

            } 
            else{
                $this->render('download404');
            }	
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
