<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectClients;
use common\models\ProjectClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        ];
    }

    /**
     * Lists all ProjectClients models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new ProjectClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single ProjectClients model.
     * @param string $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

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
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            return $this->redirect(['/projects/view', 'id' => $model->project_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            switch (\Yii::$app->request->post('submit')) {
              case 'submit':
              //return $this->redirect(['/projects/view', 'id' => $model->project_id, '#'=>'w1-tab1']);
              return $this->refresh();
              //break;
              case 'next_step':
              //print_r($model->project->setupRedirect); die();
              $model->project->setup_status = ($model->project->type=='presentation' ? 'pics' : 'docs');
              $model->project->save();

              return $this->redirect(['/project-images/create', 'ProjectImages[project_id]' => $model->project_id]);
              //break;
           }    
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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

        return $this->redirect(['/projects/view', 'id' => $model->project_id]);
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
