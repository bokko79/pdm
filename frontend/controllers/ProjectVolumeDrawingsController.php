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
     * Lists all ProjectVolumeDrawings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectVolumeDrawingsSearch();

        if($p = Yii::$app->request->get('ProjectVolumeDrawings')){
            $searchModel->project_volume_id = !empty($p['project_volume_id']) ? $p['project_volume_id'] : null;
            $model = $this->findVolume($p['project_volume_id']);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if (Yii::$app->request->post('hasEditable')) {
            $drawId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $drawing = \common\models\ProjectVolumeDrawings::findOne($drawId);
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            $ps = Yii::$app->request->post('ProjectVolumeDrawings');
            if(isset($ps[$edit]['number'])){
                $drawing->number = $ps[$edit]['number'];                    
            }
            if(isset($ps[$edit]['scale'])){
                $drawing->scale = $ps[$edit]['scale'];
            }            
            if(isset($ps[$edit]['name'])){
                $drawing->name = $ps[$edit]['name'];
            }
            if(isset($ps[$edit]['title'])){
                $drawing->title = $ps[$edit]['title'];
            }
            
            $drawing->save();
            echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            return;
        }

        return $this->render('index', [
            'model' => $model,
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
            $storeys = $this->findVolume($p['project_volume_id'])->project->projectBuilding ? $this->findVolume($p['project_volume_id'])->project->projectBuilding->projectBuildingStoreys : $this->findVolume($p['project_volume_id'])->project->projectExBuilding->projectBuildingStoreys;
        }
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->name==null){
                
                $model->name = $model->fullType;
            }
            if($model->title==null){
                $model->title = $model->name;
            }
            if($model->save()){
                return $this->redirect(['/project-volume-drawings/index', 'ProjectVolumeDrawings[project_volume_id]' => $model->project_volume_id]);
            }            
        }

        return $this->render('create', [
            'model' => $model,
            'storeys' => $storeys,
        ]);
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
        $storeys = $model->projectVolume->project->projectBuilding ? $model->projectVolume->project->projectBuilding->projectBuildingStoreys : $model->projectVolume->project->projectExBuilding->projectBuildingStoreys;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-volume-drawings/index', 'ProjectVolumeDrawings[project_volume_id]' => $model->project_volume_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'storeys' => $storeys,
        ]);
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
