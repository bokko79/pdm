<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingStoreys;
use common\models\ProjectBuildingStoreysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use common\models\DynamicModel;

/**
 * ProjectBuildingStoreysController implements the CRUD actions for ProjectBuildingStoreys model.
 */
class ProjectBuildingStoreysController extends Controller
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
     * Lists all ProjectBuildingStoreys models.
     * @return mixed
     */
    public function actionIndex($id, $add_storey=null, $remove_storey=null, $copy_storey=null)
    {
        $this->layout = 'project';
        
        $model = $this->findBuildingById($id);
        $storeys = $model->projectBuildingStoreys;

        if($same = Yii::$app->request->post('ProjectBuilding')){
            $st = $this->findStoreyById($same['copiedStorey']);
            $st->same_as_id = $same['sameStorey'];
            $st->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }
        
        if($add_storey){
            $link = $this->addStorey($model, $add_storey);             
            return $this->redirect(['/project-building-storeys/update', 'id' => $link]);
        }
        if($copy_storey){
            $link = $this->copyStorey($copy_storey);  
            return $this->redirect(['/project-building-storeys/update', 'id' => $link]);
        }
        if($remove_storey){
            $this->removeStorey($remove_storey);
            return $this->redirect(['index', 'id' => $id]);     
        }        

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $sttId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $model = \common\models\ProjectBuildingStoreys::findOne($sttId);

            $ps = Yii::$app->request->post('ProjectBuildingStoreys')[$edit];
            if(isset($ps['gross_area'])){
                $model->gross_area = $ps['gross_area'];
            }
            if(isset($ps['level'])){
                $model->level = $ps['level'];
            }
            
            if(isset($ps['name'])){
                $model->name = $ps['name'];
            }
            if(isset($ps['height'])){
                $model->height = $ps['height'];
            }
            
            // can save model or do something before saving model
            $model->save();
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            echo $out;
            return;
        }
        return $this->render('index', [
            'model' => $model,
            'storeys' => $storeys,
        ]);
    }

    /**
     * Lists all ProjectBuildingStoreys models.
     * @return mixed
     */
    public function actionGenerateParts($id)
    {
        if($parts_of_storey = Yii::$app->request->post('ProjectBuildingStoreys')){
            $model = $this->findModel($id);
            $this->generateParts($model, $parts_of_storey);
            return $this->redirect(['/project-building/storeys', 'id' => $model->projectBuilding->id]);
        }
    }

    /**
     * Displays a single ProjectBuildingStoreys model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'project';
        
        $model = $this->findModel($id);
        $query_cla = \common\models\ProjectBuildingStoreyPartRooms::find()->where('id=0');
        
        if($parts = $model->projectBuildingStoreyParts){
            foreach ($parts as $key => $part) {
                $query_cla->orWhere(['project_building_storey_part_id' => $part->id]);
            }
        }        
        
        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $sttId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $model = \common\models\ProjectBuildingStoreyParts::findOne($sttId);

            $ps = Yii::$app->request->post('ProjectBuildingStoreyParts')[$edit];            
            if(isset($ps['mark'])){
                $model->mark = $ps['mark'];
            }
            
            if(isset($ps['structure'])){
                $model->structure = $ps['structure'];
            }            
            // can save model or do something before saving model
            $model->save();
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            echo $out;
            return;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),            
            'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => $query_cla->orderBy('project_building_storey_part_id ASC, CAST(mark AS UNSIGNED)')->groupBy(''),
            ]),
        ]);
    }

    /**
     * Creates a new ProjectBuildingStoreys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectBuildingStoreys();
        if($p = Yii::$app->request->get('ProjectBuildingStoreys')){
            $model->project_building_id = !empty($p['project_building_id']) ? $p['project_building_id'] : null;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-building-storeys/view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectBuildingStoreys model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsParts = [new \common\models\ProjectBuildingStoreyParts];
        //$modelsRooms = [[new \common\models\ProjectBuildingStoreyPartRooms]];
        //$modelsParts = $model->projectBuildingStoreyParts;
        //$modelsRooms = [];
        /*$oldRooms = [];

        if (!empty($modelsParts)) {
            foreach ($modelsParts as $indexPart => $modelPart) {
                $rooms = $modelPart->projectBuildingStoreyPartRooms;
                $modelsRooms[$indexPart] = $rooms;
                $oldRooms = ArrayHelper::merge(ArrayHelper::index($rooms, 'id'), $oldRooms);
            }
        }*/


        if ($model->load(Yii::$app->request->post())) {
            if($model->projectBuilding->project->work=='adaptacija'){
                $model->save();
                return $this->redirect(['/project-building-storey-parts/view', 'id' => $model->projectBuildingStoreyParts[0]->id]);
            } else {



                // reset
                //$modelsRooms = [];

                //$oldPartIDs = ArrayHelper::map($modelsParts, 'id', 'id');
                //$modelsParts = DynamicModel::createMultiple(\common\models\ProjectBuildingStoreyParts::classname(), $modelsParts);
                $modelsParts = DynamicModel::createMultiple(\common\models\ProjectBuildingStoreyParts::classname());
                DynamicModel::loadMultiple($modelsParts, Yii::$app->request->post());
                //$deletedPartsIDs = array_diff($oldPartIDs, array_filter(ArrayHelper::map($modelsParts, 'id', 'id')));

                // validate person and houses models
               // $valid = $model->validate();
               // $valid = DynamicModel::validateMultiple($modelsParts) && $valid;

               // $roomsIDs = [];
                /*if (isset($_POST['ProjectBuildingStoreyPartRooms'][0][0])) {
                    foreach ($_POST['ProjectBuildingStoreyPartRooms'] as $indexHouse => $rooms) {
                        //$roomsIDs = ArrayHelper::merge($roomsIDs, array_filter(ArrayHelper::getColumn($rooms, 'id')));
                        foreach ($rooms as $indexRoom => $room) {
                            $data['ProjectBuildingStoreyPartRooms'] = $room;
                            //$modelRoom = (isset($room['id']) && isset($oldRooms[$room['id']])) ? $oldRooms[$room['id']] : new \common\models\ProjectBuildingStoreyPartRooms;
                            $modelRoom = new \common\models\ProjectBuildingStoreyPartRooms;
                            $modelRoom->load($data);
                            $modelsRooms[$indexHouse][$indexRoom] = $modelRoom;
                            //$valid = $modelRoom->validate();
                        }
                    }
                }
*/
                // $oldRoomsIDs = ArrayHelper::getColumn($oldRooms, 'id');
                // $deletedRoomsIDs = array_diff($oldRoomsIDs, $roomsIDs);

                /*if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {

                            /*if (! empty($deletedRoomsIDs)) {
                                \common\models\ProjectBuildingStoreyPartRooms::deleteAll(['id' => $deletedRoomsIDs]);
                            }

                            if (! empty($deletedPartsIDs)) {
                                \common\models\ProjectBuildingStoreyParts::deleteAll(['id' => $deletedPartsIDs]);
                            }*/
                if ($model->save()){
                    foreach ($modelsParts as $indexPart => $modelPart) {

                        /*if ($flag === false) {
                            break;
                        }*/

                        $modelPart->project_building_storey_id = $model->id;
                        $modelPart->name = $modelPart->fullType;
                        $modelPart->mode = $model->projectBuilding->mode;
                        $modelPart->save();
                        
                    }
                }
                            
                        /*}

                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $transaction->rollBack();
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }*/


                return $this->redirect(['/project-building-storeys/index', 'id' => $model->project_building_id]);
            }            
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsParts' => (empty($modelsParts)) ? [new \common\models\ProjectBuildingStoreyParts] : $modelsParts,
                'modelsRooms' => (empty($modelsRooms)) ? [[new \common\models\ProjectBuildingStoreyPartRooms]] : $modelsRooms
            ]);
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionEditParts($id=null)
    {
        if($id){
            if($storey = $this->findModel($id)) {
                return $this->renderAjax('//project-building-storeys/_parts', [
                    'model' => $storey,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionEditStoreys($id=null)
    {
        if($id){
            if($building = $this->findBuildingById($id)) {
                return $this->renderAjax('//project-building-storeys/_storeys', [
                    'model' => $building,
                ]);
            }
        }
        return;            
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionInitParts($id=null)
    {
        if($id){
            if($storey = $this->findModel($id)) {
                return $this->renderAjax('//project-building-storeys/_init_parts', [
                    'model' => $storey,
                ]);
            }
        }
        return;            
    }

    public function addStorey($model, $add_storey)
    {
        $new =  new \common\models\ProjectBuildingStoreys();
        $new->project_building_id = $model->id;        
        $new->storey = $add_storey;
        $new->name = $add_storey;
        //$new->order_no = 1;
        $new->save();
        return $new->id;
    }

    public function copyStorey($copy_storey)
    {
        if($storey_to_copy = $this->findModel($copy_storey)){
            $new = new \common\models\ProjectBuildingStoreys();
            $new->project_building_id = $storey_to_copy->project_building_id;
            $new->same_as_id = $storey_to_copy->id;
            $new->storey = $storey_to_copy->storey;
            $new->order_no = $storey_to_copy->order_no;
            $new->name = $storey_to_copy->name.'_kopija';
            $new->gross_area = $storey_to_copy->gross_area;
            $new->level = $storey_to_copy->level+$storey_to_copy->height;
            $new->height = $storey_to_copy->height;
            $new->description = $storey_to_copy->description;
            $new->save();
            if($parts = $storey_to_copy->projectBuildingStoreyParts){
                foreach($parts as $key=>$part){
                    $new_part[$key] = new \common\models\ProjectBuildingStoreyParts();
                    $new_part[$key]->project_building_storey_id = $new->id;
                    $new_part[$key]->same_as_id = $part->id;
                    $new_part[$key]->type = $part->type;
                    $new_part[$key]->name = $part->name;
                    $new_part[$key]->mark = $part->mark;
                    $new_part[$key]->structure = $part->structure;
                    $new_part[$key]->area = $part->area;
                    $new_part[$key]->description = $part->description;
                    $new_part[$key]->save();
                    //check if part has rooms
                    if($rooms = $part->projectBuildingStoreyPartRooms){
                        foreach($rooms as $r=>$room){                        
                            $new_room[$r] = new \common\models\ProjectBuildingStoreyPartRooms();
                            $new_room[$r]->project_building_storey_part_id = $new_part[$key]->id;
                            $new_room[$r]->same_as_id = $room->id;
                            $new_room[$r]->room_type_id = $room->room_type_id;
                            $new_room[$r]->name = $room->name;
                            $new_room[$r]->mark = $room->mark;
                            $new_room[$r]->circumference = $room->circumference;
                            $new_room[$r]->flooring = $room->flooring;
                            $new_room[$r]->height = $room->height;
                            $new_room[$r]->width = $room->width;
                            $new_room[$r]->length = $room->length;
                            $new_room[$r]->sub_net_area = $room->sub_net_area;
                            $new_room[$r]->net_area = $room->net_area;
                            $new_room[$r]->save();
                        }
                    }
                }
            } 
            return $new->id; 
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }                 
    }

    public function removeStorey($remove_storey)
    {
        $st_to_remove = $this->findModel($remove_storey);    
        //check if any parts and rooms, and delete them
        if($parts = $st_to_remove->projectBuildingStoreyParts){
            foreach($parts as $part){
                //check if part has rooms
                if($rooms = $part->projectBuildingStoreyPartRooms){
                    foreach($rooms as $room){
                        $room->delete();
                    }
                }
                $part->delete();
            }
        }
        $st_to_remove->delete();
    }

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function generateParts($model, $parts_of_storey)
    {
        foreach($parts_of_storey as $key=>$count){
            if($count>0){
                for($x = 0; $x < $count; $x++){
                    $new_part[$x] = new \common\models\ProjectBuildingStoreyParts();
                    $new_part[$x]->project_building_storey_id = $model->id;
                    $new_part[$x]->type = $key;
                    $new_part[$x]->name = $new_part[$x]->fullType;
                    $new_part[$x]->mode = $model->projectBuilding->mode;
                    $new_part[$x]->mark = strval($x+1);
                    $new_part[$x]->save();                
                }                   
            }                    
        }
    }
    

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function actionParts($id, $add_part=null, $remove_part=null)
    {
        $model = $this->findModel($id);
        $parts = $model->projectBuildingStoreyParts;
        $query_cl = \common\models\ProjectBuildingStoreyParts::find()->where(['project_building_storey_id' => $id]);
        
        if($add_part){
            // do something
            $new =  new \common\models\ProjectBuildingStoreyParts();
            $new->project_building_storey_id = $model->id;
            $new->type = $add_part;
            $new->name = $new->fullType;
            $new->name = strval(count($parts)+1);
            $new->save();
            $new->saveNewRoom();
            return $this->redirect(['index', 'id' => $model->projectBuilding->id]);
        }

        if($remove_part){
            // do something
            $removing_part = $this->findPartById($remove_part);
            if($rooms = $removing_part->projectBuildingStoreyPartRooms){
                foreach($rooms as $room){
                    $room->delete();
                }
            }
            $removing_part->delete();
            return $this->redirect(['view', 'id' => $model->id]);     
        }
        
        return $this->render('parts', [
            'model' => $model,
            'parts' => $parts,
            'projectBuildingStoreyParts' => new ActiveDataProvider([
                'query' => $query_cl,
            ]),
        ]);
    }

    /**
     * Deletes an existing ProjectBuildingStoreys model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //check if any parts and rooms, and delete them
        if($parts = $model->projectBuildingStoreyParts){
            foreach($parts as $part){
                //check if part has rooms
                if($rooms = $part->projectBuildingStoreyPartRooms){
                    foreach($rooms as $room){
                        $room->delete();
                    }
                }
                $part->delete();
            }
        }
        $model->delete();

        return $this->redirect(['/project-building/storeys', 'id' => $model->project_building_id]);
    }

    /**
     * Finds the ProjectBuildingStoreys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBuildingStoreys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectBuildingStoreys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreys the loaded model
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
     * Finds the ProjectBuildingStoreys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreys the loaded model
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

    /**
     * Finds the ProjectBuildingStoreys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuildingStoreys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBuildingById($id)
    {
        if (($model = \common\models\ProjectBuilding::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
