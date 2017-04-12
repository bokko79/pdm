<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectVolumeDrawings;
use common\models\ProjectVolumeDrawingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectVolumeDrawingsController implements the CRUD actions for ProjectVolumeDrawings model.
 */
class ProjectVolumeDrawingsController extends Controller
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
     * Lists all ProjectVolumeDrawings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectVolumeDrawingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectVolumeDrawings model.
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
     * Creates a new ProjectVolumeDrawings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectVolumeDrawings();
        if($p = Yii::$app->request->get('ProjectVolumeDrawings')){
            $model->project_volume_id = !empty($p['project_volume_id']) ? $p['project_volume_id'] : null;
            $storeys = $this->findVolume($p['project_volume_id'])->project->projectBuilding->projectBuildingStoreys;
        }
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->name==null){
                
                $model->name = $model->fullType;
            }
            if($model->title==null){
                $model->title = $model->name;
            }
            if($model->save()){
                return $this->redirect(['/project-volumes/view', 'id' => $model->project_volume_id]);
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
                'storeys' => $storeys,
            ]);
        }
    }

    /**
     * Updates an existing ProjectVolumeDrawings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $storeys = $model->projectVolume->project->projectBuilding->projectBuildingStoreys;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-volumes/view', 'id' => $model->project_volume_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'storeys' => $storeys,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectVolumeDrawings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/project-volumes/view', 'id' => $model->project_volume_id]);
    }

    /**
     * Finds the ProjectVolumeDrawings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumeDrawings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectVolumeDrawings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumeDrawings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumeDrawings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVolume($id)
    {
        if (($model = \common\models\ProjectVolumes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
