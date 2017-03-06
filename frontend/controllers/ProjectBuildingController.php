<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuilding;
use common\models\ProjectBuildingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        ];
    }

    /**
     * Lists all ProjectBuilding models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectBuildingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBuilding model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'project';

        $model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingClasses::find()->where(['project_id' => $id]);
        $query_st = \common\models\ProjectBuildingStoreys::find()->where(['project_id' => $id]);
        $query_he = \common\models\ProjectBuildingHeights::find()->where(['project_id' => $id]);
        $query_pa = \common\models\ProjectBuildingParts::find()->where(['project_id' => $id]);
        $query_dw = \common\models\ProjectBuildingDoorwin::find()->where(['project_id' => $id]);
        $searchModel = new \common\models\ProjectBuildingStoreyPartRoomsSearch();
        $rooms = $searchModel->search(Yii::$app->request->queryParams);
        
        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $roomId = Yii::$app->request->post('editableKey');
            $model = \common\models\ProjectBuildingStoreyPartRooms::findOne($roomId);

            // store a default json response as desired by editable
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);

            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['ProjectBuildingStoreyPartRooms']);
            $post = ['ProjectBuildingStoreyPartRooms' => $posted];

            // load model like any single model validation
            if ($model->load($post)) {
                // can save model or do something before saving model
                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                /*if (isset($posted['buy_amount'])) {
                    $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
                }*/

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = \yii\helpers\Json::encode(['output'=>$output, 'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        return $this->render('view', [
            'model' => $model,
            'projectBuildingClasses' => new ActiveDataProvider([
                'query' => $query_cl,
            ]),
            'projectBuildingStoreys' => new ActiveDataProvider([
                'query' => $query_st,
            ]),
            'projectBuildingHeights' => new ActiveDataProvider([
                'query' => $query_he,
            ]),
            'projectBuildingParts' => new ActiveDataProvider([
                'query' => $query_pa,
            ]),
            'projectBuildingDoorwin' => new ActiveDataProvider([
                'query' => $query_dw,
            ]),
           /*'rooms' => new ActiveDataProvider([
                'query' => $rooms,
            ]),*/
            'rooms' => $rooms,
            'searchModel' => $searchModel,
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
        $storeys = $model->project->projectBuildingStoreys;

        if($same = Yii::$app->request->post('ProjectBuilding')){
            $st = $this->findStoreyById($same['copiedStorey']);
            $st->same_as_id = $same['sameStorey'];
            $st->save();
            return $this->redirect(['storeys', 'id' => $model->project_id]);
        }
        
        if($add_storey){
            $this->addStorey($model, $add_storey);             
            return $this->redirect(['storeys', 'id' => $id]);
        }
        if($copy_storey){
            $this->copyStorey($copy_storey);  
            return $this->redirect(['storeys', 'id' => $id]);
        }
        if($remove_storey){
            $this->removeStorey($remove_storey);
            return $this->redirect(['storeys', 'id' => $id]);     
        }        
        return $this->render('storeys', [
            'model' => $model,
            'storeys' => $storeys,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->buildFile = UploadedFile::getInstance($model, 'buildFile');
            if($model->save()){
                if ($model->buildFile) {
                    $image = $model->uploadFiles();
                    $model->file_id = $image;
                    $model->save();
                }
                return $this->redirect(['view', 'id' => $model->project_id]);
            } 
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function addStorey($model, $add_storey)
    {
        $new =  new \common\models\ProjectBuildingStoreys();
        $new->project_id = $model->project_id;
        $new->storey = $add_storey;
        //$new->order_no = 1;
        $new->save();
    }

    public function copyStorey($copy_storey)
    {
        if($storey_to_copy = $this->findStoreyById($copy_storey)){
            $new = new \common\models\ProjectBuildingStoreys();
            $new->project_id = $storey_to_copy->project_id;
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

        return $this->redirect(['index']);
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
    protected function findStoreyById($id)
    {
        if (($model = \common\models\ProjectBuildingStoreys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
