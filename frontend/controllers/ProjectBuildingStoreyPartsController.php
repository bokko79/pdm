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
            $model = \common\models\ProjectBuildingStoreyPartRooms::findOne($roomId);

            // load model like any single model validation
            //if ($model->load(Yii::$app->request->post('ProjectBuildingStoreyPartRooms'))) {
                $ps = Yii::$app->request->post('ProjectBuildingStoreyPartRooms');
                if(isset($ps[$edit]['net_area'])){
                    $model->net_area = $ps[$edit]['net_area'];                    
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['net_area'];
                }
                if(isset($ps['flooring'])){
                    $model->flooring = $ps['flooring'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')['flooring'];
                }
                if(isset($ps[$edit]['sub_net_area'])){
                    $model->sub_net_area = $ps[$edit]['sub_net_area'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['sub_net_area'];
                }
                
                if(isset($ps[$edit]['name'])){
                    $model->name = $ps[$edit]['name'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['name'];
                }
                if(isset($ps[$edit]['mark'])){
                    $model->mark = $ps[$edit]['mark'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['mark'];
                }
                
                // can save model or do something before saving model
                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                /*if (isset($posted['flooring'])) {
                    $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
                }*/

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = \yii\helpers\Json::encode(['output'=>$output, 'message'=>'']);
            //}
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        if ($post = Yii::$app->request->post('ProjectBuildingStoreyParts')){
            //print_r($post); die();
            foreach ($post['qty'] as $k=>$p){
                //
                if($p>0){
                    //print_r($k); die();
                    for ($x = 0; $x <= $p; $x++) {
                        // add room
                        $room[$k][$x] = new \common\models\ProjectBuildingStoreyPartRooms();
                        $room[$k][$x]->project_building_storey_part_id = $id;
                        $room[$k][$x]->room_type_id = $post['room_type_id'][$k];
                        $room[$k][$x]->save();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => $query_cl,
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
     * Deletes an existing ProjectBuildingStoreyParts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
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
}
