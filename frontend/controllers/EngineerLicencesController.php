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
    public function actionIndex($engineer_id)
    {
        $engineer = $this->findEngineer($engineer_id);
        $searchModel = new EngineerLicencesSearch();
        $searchModel->engineer_id = $engineer_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'engineer' => $engineer,
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
                return $this->redirect(['user/settings/licence-setup']);
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
                    $model->copy ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->copy->name)) : null;
                    $imagecopyFile = $model->uploadCopyFile();
                    $model->copy_id = $imagecopyFile;
                }                
                if ($model->confFile) {
                    $model->conf ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->conf->name)) : null;
                    $imageconfFile = $model->uploadConfFile();
                    $model->conf_id = $imageconfFile;
                }                
                if ($model->stampFile) {
                    $model->stamp ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->stamp->name)) : null;
                    $imagestampFile = $model->uploadStampFile();
                    $model->stamp_id = $imagestampFile;
                }                
                $model->save();
                //return $this->redirect(['engineers/view', 'id' => $model->engineer_id, '#'=>'w4-tab4']);
                return $this->redirect(['user/settings/licence-setup']);
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
        $model = $this->findModel($id);

        $model->copy ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->copy->name)) : null;
        $model->conf ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->conf->name)) : null;
        $model->stamp ? unlink(\Yii::getAlias('images/legal_files/licences/'.$model->stamp->name)) : null;

        $this->findModel($id)->delete();

        //return $this->redirect(['engineers/view', 'id' => $model->engineer_id, '#'=>'w4-tab4']);
        return $this->redirect(['user/settings/licence-setup']);
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

    /**
     * Finds the EngineerLicences model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EngineerLicences the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEngineer($id)
    {
        if (($model = \common\models\Engineers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
