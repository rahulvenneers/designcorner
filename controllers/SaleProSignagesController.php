<?php

namespace app\controllers;

use Yii;
use app\models\SaleProSignages;
use app\models\SaleProSignagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SaleProSignagesController implements the CRUD actions for SaleProSignages model.
 */
class SaleProSignagesController extends Controller
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
     * Lists all SaleProSignages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleProSignagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SaleProSignages model.
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
     * Creates a new SaleProSignages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pro_id,$shop_id)
    {
        $model = new SaleProSignages();
        $model->pro_id=$pro_id;
        $model->shop_id=$shop_id;
        if ($model->load(Yii::$app->request->post()) ) {
             $imageName=trim($model->id);
            if($model->image = UploadedFile::getInstance($model, 'image'))
            {
                $model->design='uploads/signages/sale/'.$imageName.'.'.$model->image->extension;
                $model->image->saveAs('uploads/brands/logo/'.$imageName.'.'.$model->image->extension);
            }
            $model->image=null;
            if( $model->save()){
                 return $this->redirect(['view', 'id' => $model->id]);
            }  
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SaleProSignages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())  ) {
            $imageName=trim($model->id);
            if($model->image = UploadedFile::getInstance($model, 'image'))
            {
                $model->design='uploads/signages/sale/'.$imageName.'.'.$model->image->extension;
                $model->image->saveAs('uploads/signages/sale/'.$imageName.'.'.$model->image->extension);
            }
            $model->image=null;
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
     * Deletes an existing SaleProSignages model.
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
     * Finds the SaleProSignages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SaleProSignages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SaleProSignages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
