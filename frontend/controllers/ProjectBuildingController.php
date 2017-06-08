<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuilding;
use common\models\ProjectBuildingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * ProjectBuildingController implements the CRUD actions for ProjectBuilding model.
 */
class ProjectBuildingController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'storeys', 'view'],
                'rules' => [
                    [
                        'actions' => ['update', 'storeys', 'view'],
                        'allow' => true,
                        'roles' => ['engineer'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'project';

        /*$model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingClasses::find()->where(['project_building_id' => $id]);
        $query_st = \common\models\ProjectBuildingStoreys::find()->where(['project_building_id' => $id])->orderBy('level');
        $query_he = \common\models\ProjectBuildingHeights::find()->where(['project_building_id' => $id]);
        $query_pa = \common\models\ProjectBuildingParts::find()->where(['project_building_id' => $id]);
        $query_dw = \common\models\ProjectBuildingDoorwin::find()->where(['project_building_id' => $id]);*
        $searchModel = new \common\models\ProjectBuildingStoreyPartRoomsSearch();
        $rooms = $searchModel->search(Yii::$app->request->queryParams);*/

        $modelCheck = $this->findModel($id);
        $model = null;
        $model_new = null;
        $building = null;
        if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){
            if($modelCheck->mode=='new'){
                $model = $this->findExModel($id);
                $model_new = $modelCheck;  
                              
            } else {
                $model = $modelCheck;
                $model_new = $this->findNewModel($id);             
            }            
            $query_cl = \common\models\ProjectBuildingClasses::find()->where(['project_building_id' => $model->id]);
            $query_he = \common\models\ProjectBuildingHeights::find()->where(['project_building_id' => $model->id]);
            $query_cl_new = \common\models\ProjectBuildingClasses::find()->where(['project_building_id' => $model_new->id]);
            $query_he_new = \common\models\ProjectBuildingHeights::find()->where(['project_building_id' => $model_new->id]);
        } else {          
            $modelCheck = $this->findModel($id);
            $model = $this->findModel($id);  
            $query_cl = \common\models\ProjectBuildingClasses::find()->where(['project_building_id' => $id]);
            $query_he = \common\models\ProjectBuildingHeights::find()->where(['project_building_id' => $id]);
            $query_cl_new = null;
            $query_he_new = null;
        }
        

        return $this->render('view', [
            'model' => $model,
            'model_new' => $model_new,
            'modelCheck' => $modelCheck,
            'projectBuildingClasses' => new ActiveDataProvider([
                'query' => $query_cl,
            ]),
            'projectBuildingClasses_new' => new ActiveDataProvider([
                'query' => $query_cl_new,
            ]),
            /*'projectBuildingStoreys' => new ActiveDataProvider([
                'query' => $query_st,
            ]),*/
            'projectBuildingHeights' => new ActiveDataProvider([
                'query' => $query_he,
            ]),
            'projectBuildingHeights_new' => new ActiveDataProvider([
                'query' => $query_he_new,
            ]),
            /*'projectBuildingParts' => new ActiveDataProvider([
                'query' => $query_pa,
            ]),
            'projectBuildingDoorwin' => new ActiveDataProvider([
                'query' => $query_dw,
            ]),*/
           /*'rooms' => new ActiveDataProvider([
                'query' => $rooms,
            ]),*/
            /*'rooms' => $rooms,
            'searchModel' => $searchModel,*/
        ]);
    }

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function actionStoreys($id, $add_storey=null, $remove_storey=null, $copy_storey=null)
    {
        $this->layout = 'project';
        
        $model = $this->findModel($id);        
        $storeys = $model->orderedStoreys;
        $spratovi = $model->storeys;

        // Check if there is an Editable ajax request
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $posId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $story = \common\models\ProjectBuildingStoreys::findOne($posId);

            $st = Yii::$app->request->post('ProjectBuildingStoreys');
            if(isset($st[$edit]['height'])){
                $story->height = $st[$edit]['height'];
                if($story->copies){
                    foreach($story->copies as $copy){
                        $copy->height = $st[$edit]['height'];
                        $copy->save();
                    }
                }
            }
            if(isset($st[$edit]['name'])){
                $story->name = $st[$edit]['name'];
            }
            if(isset($st[$edit]['gross_area'])){
                $story->gross_area = $st[$edit]['gross_area'];
                if($story->copies){
                    foreach($story->copies as $copy){
                        $copy->gross_area = $st[$edit]['gross_area'];
                        $copy->save();
                    }
                }
            }                
            // can save model or do something before saving model
            $story->save();

            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            echo $out;
            return;

        }  

        foreach($model->projectBuildingStoreys as $stry){
            $stry->generateLevel();
        }      

        if($same = Yii::$app->request->post('ProjectBuilding')){
            $st = $this->findStoreyById($same['copiedStorey']);
            $st->same_as_id = $same['sameStorey'];
            $st->save();
            return $this->redirect(['/project-building/storeys', 'id'=>$id]);
        }
        
        if($add_storey){
            $link = $this->addStorey($model, $add_storey);             
            return $this->redirect(['/project-building/storeys', 'id'=>$id]);
        }
        if($copy_storey){
            $link = $this->copyStorey($copy_storey);  
            return $this->redirect(['/project-building/storeys', 'id'=>$id]);
        }
        if($remove_storey){
            $this->removeStorey($remove_storey);
            return $this->redirect(['/project-building/storeys', 'id'=>$id]); 
        }       

        return $this->render('storeys', [
            'model' => $model,
            'storeys' => $storeys,
            'spratovi' => $spratovi,
        ]);
    }

    /**
     * Updates an existing ProjectBuilding model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'project';
        
        $modelCheck = $this->findModel($id);        
        $model = null;
        $model_new = null;
        $building = null;
        if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){
            if($modelCheck->mode=='new'){
                $model = $this->findExModel($id);
                $model_new = $modelCheck;
                $building = [            
                    'existing' => $this->findExModel($id),
                    'new' => $modelCheck,
                ];        
                $building['existing']->scenario = 'building_update';   
                $building['new']->scenario = 'building_update';     
            } else {
                $model = $modelCheck;
                $model_new = $this->findNewModel($id);
                $building = [            
                    'existing' => $modelCheck,
                    'new' => $this->findNewModel($id),
                ];
                $building['existing']->scenario = 'building_update';
                $building['new']->scenario = 'building_update'; 
            }
            $architecture = [            
                'existing' => $model ? $model->projectBuildingCharacteristics : null,
                'new' => $model_new ? $model_new->projectBuildingCharacteristics : null,
            ];
            $structure = [            
                'existing' => $model ? $model->projectBuildingStructure : null,
                'new' => $model_new ? $model_new->projectBuildingStructure : null,
            ];
            $materials = [            
                'existing' => $model ? $model->projectBuildingMaterials : null,
                'new' => $model_new ? $model_new->projectBuildingMaterials : null,
            ];
            $insulations = [            
                'existing' => $model ? $model->projectBuildingInsulations : null,
                'new' => $model_new ? $model_new->projectBuildingInsulations : null,
            ];
            $services = [            
                'existing' => $model ? $model->projectBuildingServices : null,
                'new' => $model_new ? $model_new->projectBuildingServices : null,
            ];
        } else {
            $building = $modelCheck;
            $architecture = $modelCheck->projectBuildingCharacteristics;
            $structure = $modelCheck->projectBuildingStructure;
            $materials = $modelCheck->projectBuildingMaterials;
            $insulations = $modelCheck->projectBuildingInsulations;
            $services = $modelCheck->projectBuildingServices;
        }

        if ($modelCheck->load(Yii::$app->request->post())){
            if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){

                $this->validateMultipleBuilding($building, $architecture, $structure, $materials, $insulations, $services);
                        
                foreach ($building as $build) {
                    if($build){
                        foreach($build->projectBuildingStoreys as $stry){
                            $stry->generateLevel();
                        }
                    }                    
                }
                if(\Yii::$app->request->post('step_form')){
                    $modelCheck->project->setup_status = 'storeys_ex';
                    $modelCheck->project->save();
                    return $this->redirect($modelCheck->project->setupRedirect);
                }
                return $this->refresh();

            } else {

                $this->validateBuilding($building, $architecture, $structure, $materials, $insulations, $services);
                foreach($building->projectBuildingStoreys as $stry){
                    $stry->generateLevel();
                }
                if(\Yii::$app->request->post('step_form')){
                    $modelCheck->project->setup_status = ($building->mode=='existing') ? 'storeys_ex' : 'storeys_new';
                    $modelCheck->project->save();
                    return $this->redirect($modelCheck->project->setupRedirect);
                }
                return $this->refresh();
            }                  
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_new' => $model_new,
                'modelCheck' => $modelCheck,
                'building' => $building,
                'architecture' => $architecture,
                'structure' => $structure,
                'materials' => $materials,
                'insulations' => $insulations,
                'services' => $services,
            ]);
        }
            /* } else {
                // promena, ozakonjenje, adaptacija
                if ($model->load(Yii::$app->request->post())) {                    
                    $model->save();
                    $this->validateBuilding($building, $architecture, $structure, $materials, $insulations, $services);
                    return $this->redirect(['view', 'id' => $model->id]);
                }  else {
                    return $this->render('update', [
                        'model' => $model,
                        'model_new' => $model_new,
                        'modelCheck' => $modelCheck,
                        'building' => $building,
                        'architecture' => $architecture,
                        'structure' => $structure,
                        'materials' => $materials,
                        'insulations' => $insulations,
                        'services' => $services,
                    ]);
                }
            }
        } else {
            // izgradnja
            if ($model_new->load(Yii::$app->request->post())) {                    
                $model_new->save();
                $this->validateBuilding($building, $architecture, $structure, $materials, $insulations, $services);
                return $this->redirect(['view', 'id' => $model->id]);
            }  else {
                    return $this->render('update', [
                        'model' => $model,
                        'model_new' => $model_new,
                        'modelCheck' => $modelCheck,
                        'building' => $building,
                        'architecture' => $architecture,
                        'structure' => $structure,
                        'materials' => $materials,
                        'insulations' => $insulations,
                        'services' => $services,
                    ]);
                }
        }*/
        
    }

    public function addStorey($model, $add_storey)
    {
        $new =  new \common\models\ProjectBuildingStoreys();
        $new->project_building_id = $model->id;
        $new->storey = $add_storey;
        $new->height = $model->sp ? $model->sp[0]->height : 3;
        $new->gross_area = $model->sp ? $model->sp[0]->gross_area : 0;
        // order_no
        if($add_storey=='sprat'){
            $new->order_no = count($model->sp)+1;
            $new->name = (count($model->sp)+1).'. '.$add_storey;
        } elseif($add_storey=='podrum') {
            $new->order_no = count($model->po)+1;
            $new->name = $add_storey. ' '.(count($model->po)+1);
        } elseif($add_storey=='potkrovlje') {
            $new->order_no = count($model->pk)+1;
            $new->name = $add_storey. ' '.(count($model->pk)+1);
        } elseif($add_storey=='povucenisprat') {
            $new->order_no = count($model->ps)+1;
            $new->name = $add_storey. ' '.(count($model->ps)+1);
        } elseif($add_storey=='mansarda') {
            $new->order_no = count($model->m)+1;
            $new->name = $add_storey. ' '.(count($model->m)+1);
        } else {
            $new->order_no = 1;
            $new->name = $add_storey;
        }
            
        $new->save();

        \Yii::$app->session->setFlash('info', '<i class="fa fa-bell"></i> Etaža '.$add_storey. ' je uspešno dodata. Podesi naziv etaže, visinu, visinsku kotu i bruto površinu etaže.');
        return $new->id;
    }

    public function copyStorey($copy_storey)
    {
        if($storey_to_copy = $this->findStoreyById($copy_storey)){
            $model = $storey_to_copy->projectBuilding;
            $new = new \common\models\ProjectBuildingStoreys();
            $new->project_building_id = $storey_to_copy->project_building_id;
            $new->same_as_id = $storey_to_copy->id;
            $new->storey = $storey_to_copy->storey;
            //$new->order_no = $storey_to_copy->order_no;
            //$new->name = $storey_to_copy->name.'_kopija';
            if($storey_to_copy->storey=='sprat'){
                $new->order_no = count($model->sp)+1;
                $new->name = (count($model->sp)+1).'. '.$storey_to_copy->storey;
            } elseif($storey_to_copy->storey=='podrum') {
                $new->order_no = count($model->po)+1;
                $new->name = $storey_to_copy->storey. ' '.(count($model->po)+1);
            } elseif($storey_to_copy->storey=='potkrovlje') {
                $new->order_no = count($model->pk)+1;
                $new->name = $storey_to_copy->storey. ' '.(count($model->pk)+1);
            } elseif($storey_to_copy->storey=='povucenisprat') {
                $new->order_no = count($model->ps)+1;
                $new->name = $storey_to_copy->storey. ' '.(count($model->ps)+1);
            } elseif($storey_to_copy->storey=='mansarda') {
                $new->order_no = count($model->m)+1;
                $new->name = $storey_to_copy->storey. ' '.(count($model->m)+1);
            } else {
                $new->order_no = 1;
                $new->name = $storey_to_copy->storey;
            }
            $new->gross_area = $storey_to_copy->gross_area;
            //$new->level = $storey_to_copy->level+$storey_to_copy->height;
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
            //\Yii::$app->session->setFlash('info', '<i class="fa fa-bell"></i> Etaža '.$copy_storey. ' je uspešno kopirana.'); 
            //return $new->id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }                 
    }

    public function removeStorey($remove_storey)
    {
        $st_to_remove = $this->findStoreyById($remove_storey);    
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
        \Yii::$app->session->setFlash('warning', '<i class="fa fa-warning"></i> Etaža '.$remove_storey. ' je obrisana.'); 
    }


    /**
     * Deletes an existing ProjectBuilding model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/project-building/storeys', 'id'=>$id]);
    }

    /**
     * Finds the ProjectBuilding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuilding the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBuilding::findOne($id)) !== null) {
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
        if (($model = ProjectBuilding::findOne($id)) !== null) {
            $new = ProjectBuilding::find()->where('project_id='.$model->project_id .' and mode="new"')->one();
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
        if (($model = ProjectBuilding::findOne($id)) !== null) {
            $new = ProjectBuilding::find()->where('project_id='.$model->project_id .' and mode="existing"')->one();
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
    protected function findStoreyById($id)
    {
        if (($model = \common\models\ProjectBuildingStoreys::findOne($id)) !== null) {
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
    protected function validateMultipleBuilding($building, $architecture, $structure, $materials, $insulations, $services)
    {
        if (\yii\base\Model::loadMultiple($building, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($building)) {
            foreach ($building as $build) {
                if($build){
                    $build->save();
                    if($build->storey and $build->storey_init==0){
                        $this->generateBuildingStoreys($build);
                        $build->storey_init = 1;
                        $build->save();
                    }
                }                    
            }               
        }
        if (\yii\base\Model::loadMultiple($architecture, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($architecture)) {
            foreach ($architecture as $architect) {
                if($architect){
                    $architect->save();
                }                    
            }               
        }
        if (\yii\base\Model::loadMultiple($structure, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($structure)) {
            foreach ($structure as $struct) {
                if($struct){
                    $struct->save();
                }
            }               
        }
        if (\yii\base\Model::loadMultiple($materials, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($materials)) {
            foreach ($materials as $material) {
                if($material){
                    $material->save();
                }
            }               
        }
        if (\yii\base\Model::loadMultiple($insulations, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($insulations)) {
            foreach ($insulations as $insulation) {
                if($insulation){
                    $insulation->save();
                }
            }               
        }
        if (\yii\base\Model::loadMultiple($services, Yii::$app->request->post()) && \yii\base\Model::validateMultiple($services)) {
            foreach ($services as $service) {
                if($service){
                    $service->save();
                }
            }               
        }
    }

    /**
     * Finds the ProjectBuilding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectBuilding the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function validateBuilding($building, $architecture, $structure, $materials, $insulations, $services)
    {
        if ($building->load(Yii::$app->request->post())) {             
            $building->save();  
            if($building->storey and $building->storey_init==0){
                $this->generateBuildingStoreys($building);
                $building->storey_init = 1;
                $building->save();
            }                              
        }
        if ($architecture->load(Yii::$app->request->post())) { 
            //print "<pre>";print_r($architecture); print "</pre>";die();
            $architecture->save();                            
        }
        if ($structure->load(Yii::$app->request->post())) { 
            $structure->save();                            
        }
        if ($materials->load(Yii::$app->request->post())) { 
            $materials->save();                            
        }
        if ($insulations->load(Yii::$app->request->post())) { 
            $insulations->save();                            
        }
        if ($services->load(Yii::$app->request->post())) { 
            $services->save();                            
        }
    }

    public function generateBuildingStoreys($model)
    {
        $storey_marks = explode("+", $model->storey);
        if($storey_marks){
            foreach($storey_marks as $key=>$storey_mark){
                if(!is_numeric($storey_mark)){
                    $new[$key] = new \common\models\ProjectBuildingStoreys();
                    $new[$key]->project_building_id = $model->id;
                    $new[$key]->order_no = 1;
                    $new[$key]->height = $model->storey_height ?: 3;
                    $new[$key]->gross_area = $model->gross_area_average ?: 0;
                    switch ($storey_mark) {
                        case 'Po': 
                            $new[$key]->storey = 'podrum';
                            $new[$key]->name = 'podrum';                        
                            break;
                        case 'Su': 
                            $new[$key]->storey = 'suteren';
                            $new[$key]->name = 'suteren';                        
                            break;
                        case 'G': 
                            $new[$key]->storey = 'galerija';
                            $new[$key]->name = 'galerija';                        
                            break;
                        case 'Ps': 
                            $new[$key]->storey = 'povucenisprat';
                            $new[$key]->name = 'povučeni sprat';                        
                            break;
                        case 'Pk': 
                            $new[$key]->storey = 'potkrovlje';
                            $new[$key]->name = 'potkrovlje';                        
                            break;
                        case 'M': 
                            $new[$key]->storey = 'mansarda';
                            $new[$key]->name = 'mansarda';                        
                            break;
                        case 'T': 
                            $new[$key]->storey = 'tavan';
                            $new[$key]->name = 'tavan';                        
                            break;
                    }
                    $new[$key]->save();
                    if(!$model->canHaveUnits()){
                        // generate part (unit)
                        $new_part[$key] = new \common\models\ProjectBuildingStoreyParts();
                        $new_part[$key]->project_building_storey_id = $new[$key]->id;
                        $new_part[$key]->mode = $model->mode;
                        $new_part[$key]->type = 'whole';
                        $new_part[$key]->name = 'prostorije';
                        $new_part[$key]->save();
                    }
                } else { // ako je broj, onda označava broj spratova
                    for ($x = 1; $x <= $storey_mark; $x++) {
                        $new[$key][$x] = new \common\models\ProjectBuildingStoreys();
                        $new[$key][$x]->project_building_id = $model->id;
                        $new[$key][$x]->storey = 'sprat';
                        $new[$key][$x]->name = $x . '. sprat';  
                        $new[$key][$x]->order_no = $x;
                        $new[$key][$x]->height = $model->storey_height ?: 3;
                        $new[$key][$x]->gross_area = $model->gross_area_average ?: 0;
                        $new[$key][$x]->same_as_id = $x>1 ? $new[$key][1]->id : null;
                        $new[$key][$x]->save();
                        if(!$model->canHaveUnits()){
                            // generate part (unit)
                            $new_part[$key][$x] = new \common\models\ProjectBuildingStoreyParts();
                            $new_part[$key][$x]->project_building_storey_id = $new[$key][$x]->id;
                            $new_part[$key][$x]->mode = $model->mode;
                            $new_part[$key][$x]->type = 'whole';
                            $new_part[$key][$x]->name = 'prostorije';
                            $new_part[$key][$x]->save();
                        }
                    }                        
                }
            }
        }        
    }
}
