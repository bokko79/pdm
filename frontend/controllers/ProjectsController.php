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
                'only' => ['index', 'view', 'update', 'activate'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'activate'],
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
        $searchModel->user_id = Yii::$app->user->id;
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

        if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {                
            $model->user_id = Yii::$app->user->id;
            $model->location_id = $location->id;
            $model->status = 'active';
            $model->time = time();
            if($model->save()){
                // initialize project
                $this->createProjectBuilding($model);
                $this->createProjectBuildingClasses($model);
                $this->createProjectBuildingCharacteristics($model);
                $this->createProjectBuildingInsulations($model);
                $this->createProjectBuildingMaterials($model);
                $this->createProjectBuildingServices($model);
                $this->createProjectBuildingStructure($model);
                $this->createProjectClient($model);
                $this->createProjectLot($model);
                $this->createProjectVolume($model);                
                if($location->lot){
                    $this->createLocationLot($location);                    
                } 
                return $this->redirect(['view', 'id' => $model->id]);
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
        $new =  new \common\models\ProjectBuilding();
        $new->project_id = $model->id;
        $new->building_id = $model->building_id;
        $new->save();
    }

    protected function createProjectBuildingClasses($model)
    {
        $projectBuildingClasses = new \common\models\ProjectBuildingClasses();
        $projectBuildingClasses->project_id = $model->project_id;
        $projectBuildingClasses->building_id = $model->building_id;
        $projectBuildingClasses->percent = 100;
        $projectBuildingClasses->save();
    }

    protected function createProjectBuildingCharacteristics($model)
    {
        $new =  new \common\models\ProjectBuildingCharacteristics();
        $new->project_id = $model->id;
        $new->save();
    }

    protected function createProjectBuildingInsulations($model)
    {
        $new =  new \common\models\ProjectBuildingInsulations();
        $new->project_id = $model->id;
        $new->save();
    }

    protected function createProjectBuildingMaterials($model)
    {
        $new =  new \common\models\ProjectBuildingMaterials();
        $new->project_id = $model->id;
        $new->save();
    }

    protected function createProjectBuildingServices($model)
    {
        $new =  new \common\models\ProjectBuildingServices();
        $new->project_id = $model->id;
        $new->save();
    }

    protected function createProjectBuildingStructure($model)
    {
        $new =  new \common\models\ProjectBuildingStructure();
        $new->project_id = $model->id;
        $new->save();
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

    protected function createProjectVolume($model)
    {
        $projectVolume =  new \common\models\ProjectVolumes();
        $projectVolume->project_id = $model->id;
        $projectVolume->volume_id = 1;
        $projectVolume->practice_id = $model->practice_id;
        $projectVolume->engineer_id = $model->engineer_id;
        $projectVolume->number = 0;
        $projectVolume->name = 'glavna sveska';
        $projectVolume->code = $model->code;
        $projectVolume->control_practice_id = $model->control_practice_id;
        $projectVolume->control_engineer_id = $model->control_engineer_id;
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
}
