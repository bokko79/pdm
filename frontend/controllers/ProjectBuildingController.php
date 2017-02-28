<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectBuilding;
use common\models\ProjectBuildingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

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
        $model = $this->findModel($id);
        $query_cl = \common\models\ProjectBuildingClasses::find()->where(['project_id' => $model->project_id]);
        $query_st = \common\models\ProjectBuildingStoreys::find()->where(['project_id' => $model->project_id]);
        $query_he = \common\models\ProjectBuildingHeights::find()->where(['project_building_id' => $id]);
        $query_ch = \common\models\ProjectBuildingCharacteristics::find()->where(['project_id' => $id]);
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
            'projectBuildingCharacteristics' => new ActiveDataProvider([
                'query' => $query_ch,
            ]),
        ]);
    }

    /**
     * Creates a new ProjectBuilding model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectBuilding();
        if($pb = Yii::$app->request->get('ProjectBuilding')){
            $model->project_id = !empty($pb['project_id']) ? $pb['project_id'] : null;
            $model->building_id = !empty($pb['building_id']) ? $pb['building_id'] : null;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $projectBuildingClasses = new \common\models\ProjectBuildingClasses();
            $projectBuildingClasses->project_id = $model->project_id;
            $projectBuildingClasses->building_id = $model->building_id;
            $projectBuildingClasses->percent = 100;
            $projectBuildingClasses->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Generates ProjectBuildingStoreys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGenerateStoreys($id)
    {
        $model = $this->findModel($id);
        $model->podrum = $model->po ? count($model->po) : 0;
        $model->suteren = $model->s ? 1 : 0;
        $model->visokoprizemlje = $model->vp ? 1 : 0;
        $model->mezanin = $model->mz ? 1 : 0;
        $model->galerija = $model->g ? 1 : 0;
        $model->sprat = $model->sp ? count($model->sp) : 0;
        $model->povucenisprat = $model->ps ? count($model->ps) : 0;
        $model->potkrovlje = $model->pk ? count($model->pk) : 0;
        $model->mansarda = $model->m ? count($model->m) : 0;
        $model->tavan = $model->t ? 1 : 0;

        if ($request = Yii::$app->request->post('ProjectBuilding')) {
            //print_r($request); die();
            $storey = '';
            if($request['podrum']>0){
                for ($x = 0; $x < $request['podrum']; $x++) {
                    $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                    $projectBuildingStoreys->project_id = $model->project_id;
                    $projectBuildingStoreys->storey = 'podrum';
                    $projectBuildingStoreys->order_no = $x+1;
                    $projectBuildingStoreys->save();
                }
                $storey .= 'Po+';
            }
            if($request['suteren']!=0){                    
                $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                $projectBuildingStoreys->project_id = $model->project_id;
                $projectBuildingStoreys->storey = 'suteren';
                $projectBuildingStoreys->save(); 
                $storey .= 'Su+';                   
            }
            $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
            $projectBuildingStoreys->project_id = $model->project_id;
            $projectBuildingStoreys->storey = 'prizemlje';
            $projectBuildingStoreys->save();
            $storey .= 'P+';
            if($request['visokoprizemlje']!=0){                    
                $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                $projectBuildingStoreys->project_id = $model->project_id;
                $projectBuildingStoreys->storey = 'visokoprizemlje';
                $projectBuildingStoreys->save();
                $storey .= 'VP+';
            }
            if($request['mezanin']!=0){                    
                $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                $projectBuildingStoreys->project_id = $model->project_id;
                $projectBuildingStoreys->storey = 'mezanin';
                $projectBuildingStoreys->save();  
                $storey .= 'MZ+';                  
            }
            if($request['galerija']!=0){                    
                $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                $projectBuildingStoreys->project_id = $model->project_id;
                $projectBuildingStoreys->storey = 'galerija';
                $projectBuildingStoreys->save(); 
                $storey .= 'G+';                   
            }
            if($request['sprat']>0){
                for ($x = 0; $x < $request['sprat']; $x++) {
                    $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                    $projectBuildingStoreys->project_id = $model->project_id;
                    $projectBuildingStoreys->storey = 'sprat';
                    $projectBuildingStoreys->order_no = $x+1;
                    $projectBuildingStoreys->save();
                }
                $storey .= $request['sprat'].'+';
            }
            if($request['povucenisprat']>0){
                for ($x = 0; $x < $request['povucenisprat']; $x++) {
                    $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                    $projectBuildingStoreys->project_id = $model->project_id;
                    $projectBuildingStoreys->storey = 'povucenisprat';
                    $projectBuildingStoreys->order_no = $x+1;
                    $projectBuildingStoreys->save();
                }
                $storey .= 'Ps+';
            }
            if($request['potkrovlje']>0){
                for ($x = 0; $x < $request['potkrovlje']; $x++) {
                    $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                    $projectBuildingStoreys->project_id = $model->project_id;
                    $projectBuildingStoreys->storey = 'potkrovlje';
                    $projectBuildingStoreys->order_no = $x+1;
                    $projectBuildingStoreys->save();
                }
                $storey .= 'Pk+';
            }
            if($request['mansarda']>0){
                for ($x = 0; $x < $request['mansarda']; $x++) {
                    $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                    $projectBuildingStoreys->project_id = $model->project_id;
                    $projectBuildingStoreys->storey = 'mansarda';
                    $projectBuildingStoreys->order_no = $x+1;
                    $projectBuildingStoreys->save();
                }
                $storey .= 'M+';
            }
            if($request['tavan']!=0){                    
                $projectBuildingStoreys = new \common\models\ProjectBuildingStoreys();
                $projectBuildingStoreys->project_id = $model->project_id;
                $projectBuildingStoreys->storey = 'tavan';
                $projectBuildingStoreys->save(); 
                $storey .= 'T';                   
            }
            if(substr($storey, -1)=='+'){substr($storey, 0, -1);}
            $model->storey = $storey;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('generate-storeys', [
                'model' => $model,
            ]);
        }
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
}
