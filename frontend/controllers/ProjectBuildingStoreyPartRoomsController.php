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
        $this->layout = 'project';
        
        $projectBuilding = $this->findProjectBuildingById($id);        
        $searchModel = new ProjectBuildingStoreyPartRoomsSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        foreach($projectBuilding->projectBuildingStoreys as $storey){
            foreach($storey->projectBuildingStoreyParts as $part){
                $dataProvider->query->orWhere('project_building_storey_part_id='.$part->id);
            }
        }
        if ($st = Yii::$app->request->get('storey')) {
            $dataProvider->query->andWhere('project_building_storey_parts.project_building_storey_id='.$st);
        }


        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $roomId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $room = \common\models\ProjectBuildingStoreyPartRooms::findOne($roomId);

            $ps = Yii::$app->request->post('ProjectBuildingStoreyPartRooms');
            if(isset($ps[$edit]['net_area'])){
                $room->net_area = $ps[$edit]['net_area']; 
                if($room->sub_net_area==null){
                    $room->sub_net_area = $room->net_area;
                }
            }
            if(isset($ps[$edit]['flooring'])){
                $room->flooring = $ps[$edit]['flooring'];
            }
            if(isset($ps[$edit]['sub_net_area'])){
                $room->sub_net_area = $ps[$edit]['sub_net_area'];
                if($room->net_area==null){
                    $room->net_area = $room->sub_net_area;
                }
            }
            
            if(isset($ps[$edit]['name'])){
                $room->name = $ps[$edit]['name'];
            }
            if(isset($ps[$edit]['mark'])){
                $room->mark = $ps[$edit]['mark'];
            }
            
            // can save model or do something before saving model
            $room->save();

            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            echo $out;
            return;
        }
        return $this->render('index', [
            'projectBuilding' => $projectBuilding,
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
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['/project-building-storey-parts/view', 'id' => $model->project_building_storey_part_id]);
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
    protected function findProjectBuildingById($id)
    {
        if (($model = \common\models\ProjectBuilding::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
