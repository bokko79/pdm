<?php

namespace frontend\controllers;

use Yii;
use common\models\EngineerLicences;
use common\models\EngineerLicencesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EngineerLicencesController implements the CRUD actions for EngineerLicences model.
 */
class EngineerLicencesController extends Controller
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
     * Lists all EngineerLicences models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EngineerLicencesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EngineerLicences model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EngineerLicences model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EngineerLicences();
        if($el = Yii::$app->request->get('EngineerLicences')){
            $model->engineer_id = !empty($el['engineer_id']) ? $el['engineer_id'] : null;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->copyFile = UploadedFile::getInstance($model, 'copyFile');
            $model->confFile = UploadedFile::getInstance($model, 'confFile');
            $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
            if($model->save()){
                if ($model->copyFile) {
                    $imagecopyFile = $model->uploadCopyFile();
                    $model->copy_id = $imagecopyFile;
                }                
                if ($model->confFile) {
                    $imageconfFile = $model->uploadConfFile();
                    $model->conf_id = $imageconfFile;
                }                
                if ($model->stampFile) {
                    $imagestampFile = $model->uploadStampFile();
                    $model->stamp_id = $imagestampFile;
                }                
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } 
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EngineerLicences model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->copyFile = UploadedFile::getInstance($model, 'copyFile');
            $model->confFile = UploadedFile::getInstance($model, 'confFile');
            $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
            if($model->save()){
                if ($model->copyFile) {
                    $imagecopyFile = $model->uploadCopyFile();
                    $model->copy_id = $imagecopyFile;
                }                
                if ($model->confFile) {
                    $imageconfFile = $model->uploadConfFile();
                    $model->conf_id = $imageconfFile;
                }                
                if ($model->stampFile) {
                    $imagestampFile = $model->uploadStampFile();
                    $model->stamp_id = $imagestampFile;
                }                
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } 
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EngineerLicences model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EngineerLicences model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EngineerLicences the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EngineerLicences::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}