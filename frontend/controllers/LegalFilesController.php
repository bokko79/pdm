<?php

namespace frontend\controllers;

use Yii;
use common\models\LegalFiles;
use common\models\LegalFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LegalFilesController implements the CRUD actions for LegalFiles model.
 */
class LegalFilesController extends Controller
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
     * Lists all LegalFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LegalFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LegalFiles model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'entity' => $this->getEntity($model->entity, $model->entity_id),
        ]);
    }

    /**
     * Creates a new LegalFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LegalFiles();
        if($lf = Yii::$app->request->get('LegalFilesSearch')){
            $model->entity_id = !empty($lf['entity_id']) ? $lf['entity_id'] : null;
            $model->entity = !empty($lf['entity']) ? $lf['entity'] : null;
            $model->type = !empty($lf['type']) ? $lf['type'] : null;  
            if ($model->load(Yii::$app->request->post())) {
                $model->docFile = UploadedFile::getInstance($model, 'docFile');
                if($model->save()){
                    if ($model->docFile) {
                        $image = $model->uploadFiles();
                        $model->file_id = $image;
                        $model->save();
                    }                    
                    return $this->redirect(['view', 'id' => $model->id]);
                }                    
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'entity' => $this->getEntity($model->entity, $model->entity_id),
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }        
    }

    /**
     * Updates an existing LegalFiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->docFile = UploadedFile::getInstance($model, 'docFile');
            if($model->save()){
                if ($model->docFile) {$image=$model->uploadFiles();}
                $model->file_id = $image;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }                    
        } else {
            return $this->render('update', [
                'model' => $model,
                'entity' => $this->getEntity($model->entity, $model->entity_id),
            ]);
        }
    }

    /**
     * Deletes an existing LegalFiles model.
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
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LegalFiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPracticeById($id)
    {
        if (($model = \common\models\Practices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEngineerById($id)
    {
        if (($model = \common\models\Engineers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findClientById($id)
    {
        if (($model = \common\models\Clients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function getEntity($entity, $id)
    {
        if ($entity == 'practice'){
            $ent = $this->findPracticeById($id);
        } else if($entity == 'engineer' or $entity == 'eng_licence'){
            $ent = $this->findEngineerById($id);
        } else if($entity == 'client'){
            $ent = $this->findClientById($id);
        }
        return $ent;
    }
}
