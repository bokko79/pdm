<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingStoreyParts;
use common\models\ProjectBuildingStoreyPartsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\models\DynamicModel;

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
        $projectBuilding = $this->findProjectBuildingById($id);

        $searchModel = new ProjectBuildingStoreyPartsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        foreach($projectBuilding->projectBuildingStoreys as $storey){            
            $dataProvider->query->orWhere('project_building_storey_id='.$storey->id);           
        }

        $dataProvider->query->innerJoin('project_building_storeys as pbs')->orderBy('pbs.level ASC')->groupBy('id');

        return $this->render('index', [
            'projectBuilding' => $projectBuilding,
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
        $this->layout = '/project';

        $model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingStoreyPartRooms::find()->where(['project_building_storey_part_id' => $id]);
        $roomTypes = \common\models\RoomTypes::find()->all();

        if($model->projectBuildingStorey->name==''){
            \Yii::$app->session->setFlash('danger', '<p><i class="fa fa-exclamation-circle"></i> Etaža na kojem se nalazi ova jedinica nije podešen. '.\yii\helpers\Html::a('<i class="fa fa-pencil"></i> Unesi naziv etaže.', \yii\helpers\Url::to(['/project-building-storeys/update', 'id'=>$model->projectBuildingStorey->id]), ['target'=>'_blank']). '</p>');
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

        if ($rooms = Yii::$app->request->post('ProjectBuildingStoreyParts')['room_to_add']){           
            //foreach($rooms as $key=>$room){
                $this->generateRooms($model, $rooms);
            //}        
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => $query_cl->orderBy('CAST(mark AS UNSIGNED)'),
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

        $modelCheck = $this->findModel($id);
        $part = null;
        if($modelCheck->projectBuildingStorey->projectBuilding->project->work=='adaptacija'){
            if($modelCheck->mode=='new'){
                $model = $this->findExModel($id);
                $model_new = $modelCheck;
                $part = [            
                    'existing' => $this->findExModel($id),
                    'new' => $modelCheck,
                ];
            } else {
                $model = $modelCheck;
                $model_new = $this->findNewModel($id);
                $part = [            
                    'existing' => $modelCheck,
                    'new' => $this->findNewModel($id),
                ];
            }
        } else {
            $model = $this->findModel($id);
        } 


        $architecture = [            
            'existing' => $model ? $model->projectBuildingStoreyPartCharacteristics : null,
            'new' => $model_new ? $model_new->projectBuildingStoreyPartCharacteristics : null,
        ];
        $structure = [            
            'existing' => $model ? $model->projectBuildingStoreyPartStructure : null,
            'new' => $model_new ? $model_new->projectBuildingStoreyPartStructure : null,
        ];
        $materials = [            
            'existing' => $model ? $model->projectBuildingStoreyPartMaterials : null,
            'new' => $model_new ? $model_new->projectBuildingStoreyPartMaterials : null,
        ];
        $insulations = [            
            'existing' => $model ? $model->projectBuildingStoreyPartInsulations : null,
            'new' => $model_new ? $model_new->projectBuildingStoreyPartInsulations : null,
        ];
        $services = [            
            'existing' => $model ? $model->projectBuildingStoreyPartServices : null,
            'new' => $model_new ? $model_new->projectBuildingStoreyPartServices : null,
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (\yii\base\Model::loadMultiple($part, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($part)) {
                foreach ($part as $par) {
                    $par->save();
                }               
            }
            if (\yii\base\Model::loadMultiple($architecture, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($architecture)) {
                foreach ($architecture as $architect) {
                    $architect->save();
                }               
            }
            if (\yii\base\Model::loadMultiple($structure, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($structure)) {
                foreach ($structure as $struct) {
                    $struct->save();
                }               
            }
            if (\yii\base\Model::loadMultiple($materials, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($materials)) {
                foreach ($materials as $material) {
                    $material->save();
                }               
            }
            if (\yii\base\Model::loadMultiple($insulations, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($insulations)) {
                foreach ($insulations as $insulation) {
                    $insulation->save();
                }               
            }
            if (\yii\base\Model::loadMultiple($services, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($services)) {
                foreach ($services as $service) {
                    $service->save();
                }               
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_new' => $model_new,
                'part' => $part,
                'architecture' => $architecture,
                'structure' => $structure,
                'materials' => $materials,
                'insulations' => $insulations,
                'services' => $services,
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
     * Finds the ProjectBuilding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuilding the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findNewModel($id)
    {
        if (($model = ProjectBuildingStoreyParts::findOne($id)) !== null) {
            $new = ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$model->project_building_storey_id .' and mode="new"')->one();
            return $new;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectBuilding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuilding the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findExModel($id)
    {
        if (($model = ProjectBuildingStoreyParts::findOne($id)) !== null) {
            $new = ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$model->project_building_storey_id .' and mode="existing"')->one();
            return $new;
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
