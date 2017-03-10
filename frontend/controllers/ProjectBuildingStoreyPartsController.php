<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingStoreyParts;
use common\models\ProjectBuildingStoreyPartsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ProjectBuildingStoreyPartsController implements the CRUD actions for ProjectBuildingStoreyParts model.
 */
class ProjectBuildingStoreyPartsController extends Controller
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
     * Lists all ProjectBuildingStoreyParts models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $project = $this->findProjectById($id);

        $searchModel = new ProjectBuildingStoreyPartsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        foreach($project->projectBuildingStoreys as $storey){            
            $dataProvider->query->orWhere('project_building_storey_id='.$storey->id);           
        }

        $dataProvider->query->innerJoin('project_building_storeys as pbs')->orderBy('pbs.level ASC')->groupBy('id');

        return $this->render('index', [
            'project' => $project,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBuildingStoreyParts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingStoreyPartRooms::find()->where(['project_building_storey_part_id' => $id]);
        $roomTypes = \common\models\RoomTypes::find()->all();

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

        if ($rooms = Yii::$app->request->post('ProjectBuildingStoreyParts')['room_to_add']){           
            //foreach($rooms as $key=>$room){
                $this->generateRooms($model, $rooms);
            //}        
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => $query_cl->orderBy('CAST(mark AS INTEGER)'),
            ]),
            'roomTypes' => $roomTypes,
        ]);
    }

    /**
     * Creates a new ProjectBuildingStoreyParts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectBuildingStoreyParts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectBuildingStoreyParts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionEditRooms($id=null)
    {
        if($id){
            if($part = $this->findModel($id)) {
                return $this->renderAjax('//project-building-storey-parts/_rooms', [
                    'model' => $part,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionInitRooms($id=null)
    {
        if($id){
            if($part = $this->findModel($id)) {
                return $this->renderAjax('//project-building-storey-parts/_init_rooms', [
                    'model' => $part,
                ]);
            }
        }
        return;            
    }

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function generateRooms($model, $rooms)
    {
        $room_container = []; // array koji sadrži sve id soba
        if($roomz = $model->projectBuildingStoreyPartRooms){
            foreach($roomz as $rm){
                $room_container[] = $rm->room_type_id;
                // remove the ones that are not on the list
                if(!in_array($rm->room_type_id, $rooms)){
                    $rm->delete();
                }
            }
        }        
        if($rooms){
            foreach($rooms as $key=>$room){
                // add new ones
                if(!in_array($room, $room_container)){
                    $room_type = $this->findRoomTypeById($room);
                    $room_n[$key] = new \common\models\ProjectBuildingStoreyPartRooms();
                    $room_n[$key]->project_building_storey_part_id = $model->id;
                    $room_n[$key]->room_type_id = $room;
                    $room_n[$key]->name = $room_type->name;
                    $room_n[$key]->mark = strval($key+1);
                    $room_n[$key]->flooring = 'keramika';
                    $room_n[$key]->save();
                }                
            }
        }                    
    }

    /**
     * Deletes an existing ProjectBuildingStoreyParts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($rooms = $model->projectBuildingStoreyPartRooms){
            foreach($rooms as $room){
                $room->delete();
            }
        }
        $this->findModel($id)->delete();

        return $this->redirect(['/project-building-storeys/view', 'id' => $model->project_building_storey_id]);
    }

    /**
     * Finds the ProjectBuildingStoreyParts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreyParts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBuildingStoreyParts::findOne($id)) !== null) {
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

    /**
     * Finds the ProjectBuildingStoreyPartRooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreyPartRooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findRoomTypeById($id)
    {
        if (($model = \common\models\RoomTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
