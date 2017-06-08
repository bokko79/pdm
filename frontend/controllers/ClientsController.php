<?php

namespace frontend\controllers;

use Yii;
use common\models\Clients;
use common\models\ClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class ClientsController extends Controller
{
    public $layout = 'dashboard';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update', 'delete'],
                'rules' => [
                    /*[
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                    [
                        'actions' => ['index', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['engineer', 'client'],
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
     * Lists all Clients models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new ClientsSearch();
        //$searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        if($id = Yii::$app->request->get('id')){
            $practice = $id ? $this->findPracticeById($id) : null;
        }

        if($practice){
            if($practice->clients){
                return $this->redirect(['update', 'id' => $practice->clients[0]->id]);
            } else {
                return $this->render('index', [
                    'practice'=>$practice,
                ]);
            } 
        } else {
            return $this->redirect(['/home']);
        }
    }

    /**
     * Displays a single Clients model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(\Yii::$app->user->can('updateOwnPractice', ['practice_engineer'=>$model->practice])){
            $query = \common\models\Projects::find()->where(['client_id' => $id]);
            return $this->render('view', [
                'model' => $model,
                'projects' => new ActiveDataProvider([
                    'query' => $query,
                ]),
            ]);
        } else {
            return $this->redirect(['/home']);
        }
            
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clients();
        $location = new \common\models\Locations();

        if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {
            $model->practice_id = Yii::$app->user->id;
            $model->location_id = $location->id;
            if($model->save()){
                return $this->redirect(['/user/settings/practice-setup', '#' => 'w9-tab2']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $location,
        ]);
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $location = $model->location;
        if(\Yii::$app->user->can('updateOwnPractice', ['practice_engineer'=>$model->practice])){

            if ($model->load(Yii::$app->request->post()) && $model->save() and $location->load(Yii::$app->request->post()) and $location->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
                'location' => $location,
            ]);
        } else {
            return $this->redirect(['/home']);
        }
    }

    /**
     * Deletes an existing Clients model.
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
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the PracticeEngineers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PracticeEngineers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPracticeById($id)
    {
        if (($model = \common\models\Practices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
