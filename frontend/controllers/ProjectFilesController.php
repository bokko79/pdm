<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectFiles;
use common\models\ProjectFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectFilesController implements the CRUD actions for ProjectFiles model.
 */
class ProjectFilesController extends Controller
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
     * Lists all ProjectFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectFiles model.
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
     * Creates a new ProjectFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectFiles();
        if($p = Yii::$app->request->get('ProjectFiles')){
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
        }
        
        if ($model->load(Yii::$app->request->post())) {
             $model->docFile = UploadedFile::getInstance($model, 'docFile');
            if($model->save()){
                if ($model->docFile) {
                    $image = $model->uploadFiles();
                    $model->file_id = $image;
                    $model->save();
                }                    
                return $this->redirect(['/projects/view', 'id' => $model->project_id, '#'=>'w1-tab2']);
            }             
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectFiles model.
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
                if ($model->docFile) {
                    $image = $model->uploadFiles();
                    $model->file_id = $image;
                    $model->save();
                } 
                return $this->redirect(['/projects/view', 'id' => $model->project_id, '#'=>'w1-tab2']);
            }                    
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectFiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/projects/view', 'id' => $model->project_id]);
    }

    /**
     * Finds the ProjectFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectFiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
