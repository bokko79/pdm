<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectVolumes;
use common\models\ProjectVolumesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ProjectVolumesController implements the CRUD actions for ProjectVolumes model.
 */
class ProjectVolumesController extends Controller
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
     * Lists all ProjectVolumes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectVolumesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectVolumes model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'project';
        
        $model = $this->findModel($id);
        $query_cla = \common\models\ProjectVolumeDrawings::find()->where('project_volume_id='.$id)->orderBy('CAST(number AS INTEGER)');
        $model->dataReqs();

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
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

        return $this->render('view', [
            'model' => $this->findModel($id),
            'projectVolumeDrawings' => new ActiveDataProvider([
                'query' => $query_cla,
            ]),
        ]);
    }

    /**
     * Creates a new ProjectVolumes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectVolumes();
        if($p = Yii::$app->request->get('ProjectVolumes')){
            $model->project_id = $p['project_id'] ? $p['project_id'] : null;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->time = time();
            $engLic = $this->findEngineerLicence($model->engineer_licence_id);
            $model->engineer_id = $engLic->engineer_id;
            if($model->name==null){
                $volume = $this->findVolumeById($model->volume_id);
                $model->name = $volume->name;
            }
            if($model->control_engineer_licence_id){
                $engLicC = $this->findEngineerLicence($model->control_engineer_licence_id);
                $model->control_engineer_id = $engLic->engineer_id;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectVolumes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $engLic = $this->findEngineerLicence($model->engineer_licence_id);
            $model->engineer_id = $engLic->engineer_id;
            if($model->control_engineer_licence_id){
                $engLicC = $this->findEngineerLicence($model->control_engineer_licence_id);
                $model->control_engineer_id = $engLic->engineer_id;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectVolumes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        // delete all the drawings

        if($drawings = $model->projectVolumeDrawings){
            foreach($drawings as $drawing){
                $drawing->delete();
            }
        }
        $model->delete();
        return $this->redirect(['/projects/view', 'id' => $model->project_id]);
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectVolumes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVolumeById($id)
    {
        if (($model = \common\models\Volumes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEngineerLicence($id)
    {
        if (($model = \common\models\EngineerLicences::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
