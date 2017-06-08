<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectLot;
use common\models\ProjectLotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProjectLotController implements the CRUD actions for ProjectLot model.
 */
class ProjectLotController extends Controller
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
                'only' => ['update', 'location', 'view'],
                'rules' => [
                    [
                        'actions' => ['update', 'location', 'view'],
                        'allow' => true,
                        'roles' => ['engineer'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays a single ProjectLot model.
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
     * Updates an existing ProjectLot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {        
        $model = $this->findModel($id);
        $model->scenario = 'lot_setup';
        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model->project])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if(\Yii::$app->request->post('step_form')){
                    $model->project->setup_status = 'lots';
                    $model->project->save();
                    return $this->redirect($model->project->setupRedirect);
                }
                return $this->refresh();
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        }
    }

    /**
     * Updates an existing ProjectLot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionLocation($id)
    {
        $this->layout = 'maps';

        $lot = $this->findModel($id);
        $model = $lot->project;
        $location = $model->location;

        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])){
            if ($location->load(Yii::$app->request->post())) {
                if($location->locationLots){
                    $ll = $location->locationLots[0];
                    $ll->lot = $location->lot;
                    $ll->save();
                } 
                if($location->save()) {
                    if(\Yii::$app->request->post('step_form')){
                        $model->setup_status = ($model->type=='presentation' ? 'building' : 'project_lot');;
                        $model->save();
                        return $this->redirect($model->setupRedirect);
                    }
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->refresh();
                }
            } else {
                return $this->render('location', [
                    'model' => $model,
                    'location' => $location,
                ]);
            }
        } else {
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        }
    }

    /**
     * Deletes an existing ProjectLot model.
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
     * Finds the ProjectLot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectLot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectLot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
