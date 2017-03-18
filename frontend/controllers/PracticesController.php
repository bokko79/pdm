<?php

namespace frontend\controllers;

use Yii;
use common\models\Practices;
use common\models\PracticesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * PracticesController implements the CRUD actions for Practices model.
 */
class PracticesController extends Controller
{
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
                    [
                        'actions' => ['index', 'view', 'update', 'delete'],
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
     * Lists all Practices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PracticesSearch();
        $searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Practices model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$this->layout = 'profile';
        
        $model = $this->findModel($id);
        $query_pe = \common\models\PracticeEngineers::find()->where(['practice_id' => $id]);
        $query = \common\models\Projects::find()->where(['practice_id' => $id]);

        return $this->render('view', [
            'model' => $model,
            'practiceEngineers' => new ActiveDataProvider([
                'query' => $query_pe,
            ]),
            'projects' => new ActiveDataProvider([
                'query' => $query,
            ]),
        ]);
    }

    /**
     * Creates a new Practices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Practices();
        $location = new \common\models\Locations();

        if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {
            $model->user_id = Yii::$app->user->id;
            $model->location_id = $location->id;
            if($model->save()){
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
     * Updates an existing Practices model.
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
     * Deletes an existing Practices model.
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
     * Finds the Practices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Practices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Practices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
