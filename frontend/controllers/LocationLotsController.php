<?php

namespace frontend\controllers;

use Yii;
use common\models\LocationLots;
use common\models\LocationLotsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LocationLotsController implements the CRUD actions for LocationLots model.
 */
class LocationLotsController extends Controller
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
     * Lists all LocationLots models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocationLotsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LocationLots model.
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
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $project = $model->location->project;
            return $this->redirect(['project-lot/view', 'id' => $project->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['project-lot/view', 'id' => $project->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        return $this->redirect(['project-lot/view', 'id' => $model->location->project->id]);
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
}
