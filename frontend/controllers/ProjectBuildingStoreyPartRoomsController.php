<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingStoreyPartRooms;
use common\models\ProjectBuildingStoreyPartRoomsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ProjectBuildingStoreyPartRoomsController implements the CRUD actions for ProjectBuildingStoreyPartRooms model.
 */
class ProjectBuildingStoreyPartRoomsController extends Controller
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
     * Lists all ProjectBuildingStoreyPartRooms models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $project = $this->findProjectById($id);        
        $searchModel = new ProjectBuildingStoreyPartRoomsSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        foreach($project->projectBuildingStoreys as $storey){
            foreach($storey->projectBuildingStoreyParts as $part){
                $dataProvider->query->orWhere('project_building_storey_part_id='.$part->id);
            }
        }

        return $this->render('index', [
            'project' => $project,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBuildingStoreyPartRooms model.
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
     * Creates a new ProjectBuildingStoreyPartRooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectBuildingStoreyPartRooms();
        if($p = Yii::$app->request->get('ProjectBuildingStoreyPartRooms')){
            $model->project_building_storey_part_id = !empty($p['project_building_storey_part_id']) ? $p['project_building_storey_part_id'] : null;
        }
        $m = $this->findPartById($p['project_building_storey_part_id']);
        if ($model->load(Yii::$app->request->post())) {
            if($model->sub_net_area==null){
                $model->sub_net_area = $model->net_area;
            }
            if($model->name==null){
                $model->name = $model->roomType->name;
            }
            if($model->mark==null){                
                $model->mark = $m ? (count($m->projectBuildingStoreyPartRooms)+1) : 1;
            }
            if($model->save()){
                 return $this->redirect(['/project-building-storey-parts/view', 'id' => $model->project_building_storey_part_id]);
            }               
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectBuildingStoreyPartRooms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-building-storey-parts/view', 'id' => $model->project_building_storey_part_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectBuildingStoreyPartRooms model.
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
     * Finds the ProjectBuildingStoreyPartRooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreyPartRooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBuildingStoreyPartRooms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectBuildingStoreyPartRooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreyPartRooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPartById($id)
    {
        if (($model = \common\models\ProjectBuildingStoreyParts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectBuildingStoreyPartRooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreyPartRooms the loaded model
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
