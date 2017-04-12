<?php

namespace frontend\controllers;

use Yii;
use common\models\Projects;
use common\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [/*'view', */'update', 'activate', 'create'],
                'rules' => [
                    [
                        'actions' => [/*'view',*/ 'update', 'activate', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $searchModel->status = 'active';
        $searchModel->visible = 1;
        //$searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'projectview';
        
        $model = $this->findModel($id);
        $query = \common\models\ProjectBuilding::find()->where(['project_id' => $id]);
        return $this->render('view', [
            'model' => $model,
            'projectBuilding' => new ActiveDataProvider([
                'query' => $query,
            ]),
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        $location = new \common\models\Locations();
        //print_r($model); die();
        if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {                
            $model->user_id = Yii::$app->user->id;
            $model->location_id = $location->id;
            $model->status = 'active';
            $model->secret = randomKey(6);            
            //$model->year = date('Y');
            //$model->exchange = 124.5;
            $model->time = time();
            if($model->save()){
                // initialize project
                $projectBuildings = $this->createProjectBuilding($model);
                $this->createProjectBuildingClasses($model, $projectBuildings);
                $this->createProjectBuildingCharacteristics($projectBuildings);
                $this->createProjectBuildingInsulations($projectBuildings);
                $this->createProjectBuildingMaterials($projectBuildings);
                $this->createProjectBuildingServices($projectBuildings);
                $this->createProjectBuildingStoreys($model, $projectBuildings);
                $this->createProjectBuildingStructure($projectBuildings);
                $this->createProjectClient($model);
                $this->createProjectLot($model);
                $this->createProjectVolume($model);
                if($location->lot){
                    $this->createLocationLot($location);                    
                } 
                \yii\helpers\FileHelper::createDirectory('images/projects/'.$model->year.'/'.$model->id);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
                
        } else {
            return $this->render('create', [
                'model' => $model,
                'location' => $location,
            ]);
        }
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'project';
        
        $model = $this->findModel($id);
        $location = $model->location;

        if ($model->load(Yii::$app->request->post()) && $model->save() and $location->load(Yii::$app->request->post()) and $location->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'location' => $location,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status= $model->status=='deleted' ? 'active' : 'deleted';
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function createProjectBuilding($model)
    {
        // creating existing and/or new projectBuilding
        // depending of the type of works
        $new = [];
        if($model->checkIfNewBuilding){
            $new[1] =  new \common\models\ProjectBuilding();
            $new[1]->project_id = $model->id;
            $new[1]->building_id = $model->building_id;
            $new[1]->mode = 'new';
            $new[1]->name = $model->building->buildingName;
            $new[1]->save();
        }
        if($model->checkIfExistingBuilding){
            $new[0] =  new \common\models\ProjectBuilding();
            $new[0]->project_id = $model->id;
            $new[0]->building_id = $model->building_id;
            $new[0]->mode = 'existing';
            $new[0]->name = $model->building->buildingName;
            $new[0]->save();
        }
        return $new;
    }

    protected function createProjectBuildingClasses($model, $projectBuildings)
    {
        if($model and $projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $projectBuildingClasses[$key] = new \common\models\ProjectBuildingClasses();
                $projectBuildingClasses[$key]->project_building_id = $projectBuilding->id;
                $projectBuildingClasses[$key]->building_id = $model->building_id;
                $projectBuildingClasses[$key]->percent = 100;
                $projectBuildingClasses[$key]->save();
            } 
        }           
    }

    protected function createProjectBuildingCharacteristics($projectBuildings)
    {
        if($projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingCharacteristics();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->save();
            }
        }
    }

    protected function createProjectBuildingInsulations($projectBuildings)
    {
        if($projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingInsulations();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->save();
            }
        }
    }

    protected function createProjectBuildingMaterials($projectBuildings)
    {
        if($projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingMaterials();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->save();
            }
        }
    }

    protected function createProjectBuildingServices($projectBuildings)
    {
        if($projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingServices();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->save();
            }
        }
    }

    protected function createProjectBuildingStoreys($model, $projectBuildings)
    {
        if($model and $projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingStoreys();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->storey = 'prizemlje';
                $new[$key]->level = 0.00;
                $new[$key]->order_no = "1";
                $new[$key]->save();
                if($model->part_type){
                    $new_ex_part[$key] = new \common\models\ProjectBuildingStoreyParts();
                    $new_ex_part[$key]->project_building_storey_id = $new[$key]->id;
                    $new_ex_part[$key]->mode = 'existing';
                    $new_ex_part[$key]->type = $model->part_type;
                    $new_ex_part[$key]->name = $new_ex_part[$key]->fullType;
                    $new_ex_part[$key]->save();
                    $this->createProjectBuildingStoreyPartCharacteristics($new_ex_part[$key]);
                    $this->createProjectBuildingStoreyPartInsulations($new_ex_part[$key]);
                    $this->createProjectBuildingStoreyPartMaterials($new_ex_part[$key]);
                    $this->createProjectBuildingStoreyPartServices($new_ex_part[$key]);
                    $this->createProjectBuildingStoreyPartStructure($new_ex_part[$key]);

                    $new_part[$key] = new \common\models\ProjectBuildingStoreyParts();
                    $new_part[$key]->project_building_storey_id = $new[$key]->id;
                    $new_part[$key]->mode = 'new';
                    $new_part[$key]->type = $model->part_type;
                    $new_part[$key]->name = $new_part[$key]->fullType;
                    $new_part[$key]->save();
                    $this->createProjectBuildingStoreyPartCharacteristics($new_part[$key]);
                    $this->createProjectBuildingStoreyPartInsulations($new_part[$key]);
                    $this->createProjectBuildingStoreyPartMaterials($new_part[$key]);
                    $this->createProjectBuildingStoreyPartServices($new_part[$key]);
                    $this->createProjectBuildingStoreyPartStructure($new_part[$key]);
                }
            }
        }
    }

    protected function createProjectBuildingStructure($projectBuildings)
    {
        if($projectBuildings){
            foreach($projectBuildings as $key=>$projectBuilding){
                $new[$key] =  new \common\models\ProjectBuildingStructure();
                $new[$key]->project_building_id = $projectBuilding->id;
                $new[$key]->save();
            }
        }
    }

    protected function createProjectBuildingStoreyPartCharacteristics($part)
    {
        if($part){            
            $new =  new \common\models\ProjectBuildingStoreyPartCharacteristics();
            $new->project_building_storey_part_id = $part->id;
            $new->save();            
        }
    }

    protected function createProjectBuildingStoreyPartInsulations($part)
    {
        if($part){            
            $new =  new \common\models\ProjectBuildingStoreyPartInsulations();
            $new->project_building_storey_part_id = $part->id;
            $new->save();            
        }
    }

    protected function createProjectBuildingStoreyPartMaterials($part)
    {
        if($part){            
            $new =  new \common\models\ProjectBuildingStoreyPartMaterials();
            $new->project_building_storey_part_id = $part->id;
            $new->save();            
        }
    }

    protected function createProjectBuildingStoreyPartServices($part)
    {
        if($part){            
            $new =  new \common\models\ProjectBuildingStoreyPartServices();
            $new->project_building_storey_part_id = $part->id;
            $new->save();            
        }
    }

    protected function createProjectBuildingStoreyPartStructure($part)
    {
        if($part){            
            $new =  new \common\models\ProjectBuildingStoreyPartStructure();
            $new->project_building_storey_part_id = $part->id;
            $new->save();            
        }
    }

    protected function createProjectClient($model)
    {
            $new =  new \common\models\ProjectClients();
            $new->project_id = $model->id;
            $new->client_id = $model->client_id;
            $new->status = 1;
            $new->save();
    }

    protected function createProjectLot($model)
    {
        $new =  new \common\models\ProjectLot();
        $new->project_id = $model->id;
        $new->conditions = 1;
        $new->type = 'gradjevinska';
        $new->save();
    }

    public function createProjectVolume($model)
    {
        $projectVolume = new \common\models\ProjectVolumes();
        $projectVolume->project_id = $model->id;
        $projectVolume->volume_id = 1;
        $projectVolume->practice_id = $model->practice_id;
        $projectVolume->engineer_id = $model->engineer_id;
        $projectVolume->engineer_licence_id = ($model->engineer->engineerLicences) ? $model->engineer->engineerLicences[0]->id : 4;
        $projectVolume->number = '0';
        $projectVolume->name = 'glavna sveska';
        $projectVolume->code = $model->code;
        $projectVolume->control_practice_id = $model->control_practice_id;
        $projectVolume->control_engineer_id = $model->control_engineer_id;
        $projectVolume->control_engineer_licence_id = ($model->controlEngineer and $model->controlEngineer->engineerLicences) ? $model->controlEngineer->engineerLicences[0]->id : 4;
        $projectVolume->save();
    }

    protected function createLocationLot($location)
    {
        $location_lot = new \common\models\LocationLots();
        $location_lot->location_id = $location->id;
        $location_lot->lot = $location->lot;
        $location_lot->type = 'object';
        $location_lot->save();
    }

    public function actionEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\PracticeEngineers::find()->where('practice_id='.$cat_id)->all();            
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->engineer_id;
                    $out[$key]['name'] = $r->engineer->name;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionControlEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\PracticeEngineers::find()->where('practice_id='.$cat_id)->all();            
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->engineer_id;
                    $out[$key]['name'] = $r->engineer->name;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionBuilderEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\PracticeEngineers::find()->where('practice_id='.$cat_id)->all();            
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->engineer_id;
                    $out[$key]['name'] = $r->engineer->name;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionSupervisionEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\PracticeEngineers::find()->where('practice_id='.$cat_id)->all();            
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->engineer_id;
                    $out[$key]['name'] = $r->engineer->name;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionPhases() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\Projects::getPhasesOfWork($cat_id);            
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r;
                    $out[$key]['name'] =\common\models\Projects::getProjectPhaseFullname($r);
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }
}
