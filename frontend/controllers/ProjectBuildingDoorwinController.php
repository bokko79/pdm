<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingDoorwin;
use common\models\ProjectBuildingDoorwinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectBuildingDoorwinController implements the CRUD actions for ProjectBuildingDoorwin model.
 */
class ProjectBuildingDoorwinController extends Controller
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
     * Lists all ProjectBuildingDoorwin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectBuildingDoorwinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBuildingDoorwin model.
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
     * Creates a new ProjectBuildingDoorwin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectBuildingDoorwin();
        if($p = Yii::$app->request->get('ProjectBuildingDoorwin')){
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-building/view', 'id' => $model->project_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectBuildingDoorwin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-building/view', 'id' => $model->project_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectBuildingDoorwin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/project-building/view', 'id' => $model->project_id]);
    }

    /**
     * Finds the ProjectBuildingDoorwin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingDoorwin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBuildingDoorwin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
