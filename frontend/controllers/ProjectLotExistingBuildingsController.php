<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectLotExistingBuildings;
use common\models\ProjectLotExistingBuildingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProjectLotExistingBuildingsController implements the CRUD actions for ProjectLotExistingBuildings model.
 */
class ProjectLotExistingBuildingsController extends Controller
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
     * Creates a new ProjectLotExistingBuildings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        if($p = Yii::$app->request->get('id')){
            $project = $p ? $this->findProjectById($p) : null;
        }

        if($project){
            if($project->projectLotExistingBuildings){
                return $this->redirect(['update', 'id' => $project->projectLotExistingBuildings[0]->id]);
            } else {
                return $this->redirect(['create', 'ProjectLotExistingBuildings[project_id]' => $project->id]);
            } 
        } else {
            return $this->redirect(['/home']);
        }
    }


    /**
     * Creates a new ProjectLotExistingBuildings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectLotExistingBuildings();
        if($p = Yii::$app->request->get('ProjectLotExistingBuildings')){
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
        }

        // access control
        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->refresh();
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = 'future_devs';
                $model->project->save();
                return $this->redirect($model->project->setupRedirect);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
        }
    }

    /**
     * Updates an existing ProjectLotExistingBuildings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // access control
        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->refresh();
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = 'future_devs';
                $model->project->save();
                return $this->redirect($model->project->setupRedirect);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
        }
    }

    /**
     * Deletes an existing ProjectLotExistingBuildings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/project-lot/view', 'id' => $model->project_id]);
    }

    /**
     * Finds the ProjectLotExistingBuildings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectLotExistingBuildings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectLotExistingBuildings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectLotExistingBuildings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectLotExistingBuildings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProjectById($id)
    {
        if (($model = \common\models\Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
