<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectQs;
use common\models\ProjectQsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ProjectQsController implements the CRUD actions for ProjectQs model.
 */
class ProjectQsController extends Controller
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
     * Lists all ProjectQs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'project';
        if($p = Yii::$app->request->get('ProjectQs')){
            $project_id = !empty($p['project_id']) ? $p['project_id'] : null;
            
        }
        $model = $this->findProjectById($project_id);

        $searchModel = new ProjectQsSearch();
        $searchModel->project_id = $project_id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=200;
        // validate if there is a editable input saved via AJAX
            if (Yii::$app->request->post('hasEditable')) {
                // instantiate your book model for saving
                $posId = Yii::$app->request->post('editableKey');
                $edit = Yii::$app->request->post('editableIndex');
                $pos = \common\models\ProjectQs::findOne($posId);

                $ps = Yii::$app->request->post('ProjectQs');
                if(isset($ps[$edit]['qty'])){
                    $pos->qty = $ps[$edit]['qty'];
                }
                if(isset($ps[$edit]['name'])){
                    $pos->name = $ps[$edit]['name'];
                }
                if(isset($ps[$edit]['action'])){
                    $pos->action = $ps[$edit]['action'];
                }                
                // can save model or do something before saving model
                $pos->save();

                $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
                echo $out;
                return;
            }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Lists all ProjectQs models.
     * @return mixed
     */
    public function actionWorks($p, $w)
    {
        $this->layout = 'project';        

        if($p and $w){    
            $model = $this->findProjectById($p);
            $work = $this->findWorkById($w);    

            $query = ProjectQs::find()->where('project_id='.$model->id.' and work_id='.$work->id)->orderBy('work_id, subwork_id'); 

            // validate if there is a editable input saved via AJAX
            if (Yii::$app->request->post('hasEditable')) {
                // instantiate your book model for saving
                $posId = Yii::$app->request->post('editableKey');
                $edit = Yii::$app->request->post('editableIndex');
                $pos = \common\models\ProjectQs::findOne($posId);

                $ps = Yii::$app->request->post('ProjectQs');
                if(isset($ps[$edit]['qty'])){
                    $pos->qty = $ps[$edit]['qty'];
                }
                if(isset($ps[$edit]['name'])){
                    $pos->name = $ps[$edit]['name'];
                }
                if(isset($ps[$edit]['action'])){
                    $pos->action = $ps[$edit]['action'];
                }                
                // can save model or do something before saving model
                $pos->save();

                $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
                echo $out;
                return;
            }

            return $this->render('works', [
                'projectQs' => new ActiveDataProvider([
                    'query' => $query,
                ]),
                'model' => $model,
                'work' => $work,
            ]);
        } else {
             throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionPositions($id=null, $project=null)
    {
        if($id and $project){
            $model = new ProjectQs();
            if($work = $this->findWorkById($id) and $project = $this->findProjectById($project)) {
                return $this->render('positions', [
                    'model' => $model,
                    'work' => $work,
                    'project' => $project,
                ]);
            }
        }
        return;            
    }


    /**
     * Lists all ProviderServices models.
     * @return mixed
     */
    public function actionInitWorks($id=null, $project=null)
    {
        if($id and $project){
            $model = new ProjectQs();
            if($work = $this->findWorkById($id) and $project = $this->findProjectById($project)) {
                return $this->renderAjax('//project-qs/_init_works', [
                    'model' => $model,
                    'work' => $work,
                    'project' => $project,
                ]);
            }
        }
        return;            
    }

    /**
     * Displays a single ProjectQs model.
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
     * Creates a new ProjectQs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {       
        if ($posts = Yii::$app->request->post('ProjectQs')) {
            $project = $this->findProjectById($posts['project_id']);
            $existingProjectQs = $project->projectQs;
            $exPQs = [];
            foreach($existingProjectQs as $existingProjectQ){
                $exPQs[] = $existingProjectQ->position_id;
                /*if(!in_array($existingProjectQ->position_id, $posts['position_id'])){
                    $existingProjectQ->delete();
                }*/
            }
            foreach($posts['position_id'] as $key=>$post){               

                if(!in_array($post, $exPQs)){
                    $position[$key] = $this->findPositionById($post);
                    $pqs[$key] = new ProjectQs();
                    $pqs[$key]->project_id = $project->id; 
                    $pqs[$key]->work_id = $position[$key]->subwork->work_id;               
                    $pqs[$key]->subwork_id = $position[$key]->subwork_id;
                    $pqs[$key]->position_id = $position[$key]->id;
                    $pqs[$key]->name = $position[$key]->name;
                    $pqs[$key]->action = $position[$key]->action->action;
                    $pqs[$key]->qty = $position[$key]->unit==1 ? 1 : 0;
                    $pqs[$key]->save();
                }
                    
            }
            return $this->redirect(['/project-qs/works', 'p' => $project->id, 'w' => $this->findPositionById($posts['position_id'][0])->subwork->work_id]);
        }
    }

    /**
     * Updates an existing ProjectQs model.
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
     * Deletes an existing ProjectQs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/project-qs/works', 'p' => $model->project_id, 'w' => $model->work_id]);
    }

    /**
     * Finds the ProjectQs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectQs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectQs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectQs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectQs the loaded model
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

    /**
     * Finds the ProjectQs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectQs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWorkById($id)
    {
        if (($model = \common\models\QsWorks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectQs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectQs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPositionById($id)
    {
        if (($model = \common\models\QsPositions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
