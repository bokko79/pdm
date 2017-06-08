<?php

namespace frontend\controllers;

use Yii;
use common\models\LocationLots;
use common\models\LocationLotsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LocationLotsController implements the CRUD actions for LocationLots model.
 */
class LocationLotsController extends Controller
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
                'only' => ['update', 'create', 'index'],
                'rules' => [
                    [
                        'actions' => ['update', 'create', 'index'],
                        'allow' => true,
                        'roles' => ['engineer'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all LocationLots models.
     * @return mixed
     */
    public function actionIndex()
    {
        if($ll = Yii::$app->request->get('LocationLots')){
            $project = $ll['project_id'] ? $this->findProjectById($ll['project_id']) : null;
        }

        /*if($project){
            if($project->location->locationLots){
                return $this->redirect(['update', 'id' => $project->location->locationLots[0]->id]);
            } else {
                return $this->render('index', [
                    'project'=>$project,
                ]);
            } 
        } else {
            return $this->redirect(['/home']);
        }*/
        if(\Yii::$app->user->can('viewProject', ['project'=>$project])){
            if(\Yii::$app->request->post('step_form')){
                $project->setup_status = 'existing_buildings';
                $project->save();
                return $this->redirect($project->setupRedirect);
            } else {
                return $this->render('index', [
                        'project'=>$project,
                    ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
        }           
                       
    }

    /**
     * Creates a new LocationLots model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LocationLots();
        if($ll = Yii::$app->request->get('LocationLots')){
            $model->location_id = $ll['location_id'] ? $ll['location_id'] : null;
            $model->type = $ll['type'] ? $ll['type'] : null;
            $location = $this->findLocationById($ll['location_id']);
        }
        // access control
        if(\Yii::$app->user->can('viewProject', ['project'=>$location->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $project = $model->location->project;
                return $this->redirect(['index', 'LocationLots[project_id]' => $project->id]);
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
     * Updates an existing LocationLots model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $project = $model->location->project;
        // access control
        if(\Yii::$app->user->can('viewProject', ['project'=>$project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'LocationLots[project_id]' => $project->id]);
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
     * Deletes an existing LocationLots model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index', 'LocationLots[project_id]' => $model->location->project->id]);
    }

    /**
     * Finds the LocationLots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LocationLots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocationLots::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LocationLots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LocationLots the loaded model
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

    /**
     * Finds the LocationLots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LocationLots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findLocationById($id)
    {
        if (($model = \common\models\Locations::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
