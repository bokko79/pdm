<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectImages;
use common\models\ProjectImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ProjectImagesController implements the CRUD actions for ProjectImages model.
 */
class ProjectImagesController extends Controller
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
     * Creates a new ProjectImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectImages();
        if($p = Yii::$app->request->get('ProjectImages')){
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
            $searchModel = new ProjectImagesSearch();
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
                $model->project->setup_status = 'volumes';
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
     * Updates an existing ProjectImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ProjectImagesSearch();
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
                $model->project->setup_status = 'volumes';
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
     * Deletes an existing ProjectImages model.
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

        return $this->redirect(['create', 'ProjectImages[project_id]' => $model->project_id]);
    }

    /**
     * Finds the ProjectImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
