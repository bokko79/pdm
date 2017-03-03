<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuildingStoreys;
use common\models\ProjectBuildingStoreysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

/**
 * ProjectBuildingStoreysController implements the CRUD actions for ProjectBuildingStoreys model.
 */
class ProjectBuildingStoreysController extends Controller
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
     * Lists all ProjectBuildingStoreys models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectBuildingStoreysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBuildingStoreys model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingStoreyParts::find()->where(['project_building_storey_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projectBuildingStoreyParts' => new ActiveDataProvider([
                'query' => $query_cl,
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
            $model->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project-building-storeys/view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        
        if($add_part){
            // do something
            $new =  new \common\models\ProjectBuildingStoreyParts();
            $new->project_building_storey_id = $model->id;
            $new->type = $add_part;
            $new->save(); 
            return $this->redirect(['parts', 'id' => $id]);
        }

        if($remove_part){
            // do something
            $this->findPartById($remove_part)->delete();    
            return $this->redirect(['parts', 'id' => $id]);     
        }
        
        return $this->render('parts', [
            'model' => $model,
            'parts' => $parts,
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
        $this->findModel($id)->delete();

        return $this->redirect(['/project-building/storeys', 'id' => $model->project_id]);
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
}
