<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectFiles;
use common\models\ProjectFilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ProjectFilesController implements the CRUD actions for ProjectFiles model.
 */
class ProjectFilesController extends Controller
{
    public $layout = 'project';
    
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'create'],
                'rules' => [
                    [
                        'actions' => ['update', 'create'],
                        'allow' => true,
                        'roles' => ['engineer'],
                    ],
                ],
            ],
        ];
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
            $model->type = !empty($p['type']) ? $p['type'] : null;
            $searchModel = new ProjectFilesSearch();
            $searchModel->project_id = $model->project_id;
        }

        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){        
            if ($model->load(Yii::$app->request->post())) {
                $model->docFile = UploadedFile::getInstance($model, 'docFile');
                if($model->save()){
                    if ($model->docFile) {
                        $image = $model->uploadFiles();
                        $model->file_id = $image;
                        $model->save();
                    }                    
                    return $this->refresh();
                }             
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = 'pics';
                $model->project->save();
                return $this->redirect($model->project->setupRedirect);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
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
        $searchModel = new ProjectFilesSearch();
        $searchModel->project_id = $model->project_id;

        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post())) {
                $model->docFile = UploadedFile::getInstance($model, 'docFile');
                if($model->save()){
                    if ($model->docFile) {
                        $model->file ? unlink(\Yii::getAlias('images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name)) : null;
                        $image = $model->uploadFiles();
                        $model->file_id = $image;
                        $model->save();
                    } 
                    return $this->refresh();
                }                    
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = 'pics';
                $model->project->save();
                return $this->redirect($model->project->setupRedirect);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
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
        $model->file ? unlink(\Yii::getAlias('images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name)) : null;        
        $model->delete();
        $model->file->delete();

        return $this->redirect(['create', 'ProjectFiles[project_id]' => $model->project_id]);
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
