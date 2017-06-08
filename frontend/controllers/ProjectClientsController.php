<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectClients;
use common\models\ProjectClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProjectClientsController implements the CRUD actions for ProjectClients model.
 */
class ProjectClientsController extends Controller
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
     * Creates a new ProjectClients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectClients();
        if($p = Yii::$app->request->get('ProjectClients')){
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
            $searchModel = new ProjectClientsSearch();
            $searchModel->project_id = $model->project_id;
        }

        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->refresh();        
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = ($model->project->type=='presentation' ? 'pics' : 'docs');
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
     * Updates an existing ProjectClients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {     
        $model = $this->findModel($id); 
        $searchModel = new ProjectClientsSearch();
        $searchModel->project_id = $model->project_id;       
        if(\Yii::$app->user->can('viewProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->refresh();            
            } elseif(\Yii::$app->request->post('step_form')){
                $model->project->setup_status = ($model->project->type=='presentation' ? 'pics' : 'docs');
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
     * Deletes an existing ProjectClients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['create', 'ProjectClients[project_id]' => $model->project_id]);
    }

    /**
     * Finds the ProjectClients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectClients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectClients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
