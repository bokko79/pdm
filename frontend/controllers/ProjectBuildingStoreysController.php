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
        $query_cla = \common\models\ProjectBuildingStoreyPartRooms::find();
        
        foreach ($model->projectBuildingStoreyParts as $key => $part) {
            $query_cla->orWhere(['project_building_storey_part_id' => $part->id]);
        }
        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $roomId = Yii::$app->request->post('editableKey');
            $edit = Yii::$app->request->post('editableIndex');
            $room = \common\models\ProjectBuildingStoreyPartRooms::findOne($roomId);

            // store a default json response as desired by editable
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);

            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['ProjectBuildingStoreyPartRooms']);
            $post = ['ProjectBuildingStoreyPartRooms' => $posted];

            // load model like any single model validation
            //if ($model->load(Yii::$app->request->post('ProjectBuildingStoreyPartRooms'))) {
                $ps = Yii::$app->request->post('ProjectBuildingStoreyPartRooms');
                if(isset($ps[$edit]['net_area'])){
                    $room->net_area = $ps[$edit]['net_area'];                    
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['net_area'];
                }
                if(isset($ps['flooring'])){
                    $room->flooring = $ps['flooring'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')['flooring'];
                }
                if(isset($ps[$edit]['sub_net_area'])){
                    $room->sub_net_area = $ps[$edit]['sub_net_area'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['sub_net_area'];
                }
                
                if(isset($ps[$edit]['name'])){
                    $room->name = $ps[$edit]['name'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['name'];
                }
                if(isset($ps[$edit]['mark'])){
                    $room->mark = $ps[$edit]['mark'];
                    $output = Yii::$app->request->post('ProjectBuildingStoreyPartRooms')[$edit]['mark'];
                }
                
                // can save model or do something before saving model
                $room->save();

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

        return $this->render('view', [
            'model' => $this->findModel($id),            
            'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => $query_cla->orderBy('project_building_storey_part_id ASC, id ASC, mark ASC')->groupBy(''),
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
        $query_cl = \common\models\ProjectBuildingStoreyParts::find()->where(['project_building_storey_id' => $id]);
        
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
