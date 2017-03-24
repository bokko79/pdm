<?php

namespace frontend\controllers;

use Yii;
use common\models\Requests;
use common\models\RequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * RequestsController implements the CRUD actions for Requests model.
 */
class RequestsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update', 'delete', ],
                'rules' => [
                    /*[
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['client'],
                    ],*/
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['engineer', 'client'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['client'],
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
     * Lists all Requests models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requests model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $query = \common\models\RequestComments::find()->where(['request_id' => $id]);
        $comment = new \common\models\RequestComments();
        if ($comment->load(Yii::$app->request->post())) { 
            $comment->user_id = \Yii::$app->user->id;
            $comment->request_id = $model->id;
            $comment->time = time();
            $comment->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $files = $model->requestFiles;
        return $this->render('view', [
            'model' => $model,
            'comments' => new ActiveDataProvider([
                'query' => $query->orderBy('time DESC'),
            ]),
            'files' => $files,
            'comment' => $comment,
        ]);
    }

    /**
     * Creates a new Requests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Requests();
        $location = new \common\models\Locations();
        if(\Yii::$app->user->can('client')){
            if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) { 
                $model->client_id = \Yii::$app->user->id;
                $model->location_id = $location->id;
                $model->object_type = $model->object_type ?: 'building';
                $model->status = 'active';
                $model->time = time();
                $model->docFile = UploadedFile::getInstance($model, 'docFile');
                if($model->save()){
                 if ($model->docFile) {
                        $image = $model->uploadFiles();
                        $r_file = new \common\models\RequestFiles();
                        $r_file->file_id = $image;
                        $r_file->request_id = $model->id;
                        $r_file->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }                
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'location' => $location,
                ]);
            }
        } else {
            return $this->redirect(['/user/registration/register-client']);
        }
    }

    /**
     * Updates an existing Requests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $location = $model->location;
        if(\Yii::$app->user->can('updateOwnOrder', ['order'=>$model])){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'location' => $location,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
        }
    }

    /**
     * Deletes an existing Requests model.
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
     * Finds the Requests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Requests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
