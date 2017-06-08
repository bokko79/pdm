<?php

namespace frontend\controllers;

use Yii;
use common\models\Engineers;
use common\models\EngineersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * EngineersController implements the CRUD actions for Engineers model.
 */
class EngineersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [/*'index', 'view',*/ 'update'],
                'rules' => [
                    /*[
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],*/
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['engineer'],
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
     * Lists all Engineers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EngineersSearch();
        //$searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Engineers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$this->layout = 'profile'; 
        
        $model = $this->findModel($id);
        $query_files = \common\models\LegalFiles::find()->where(['entity_id' => $id, 'entity' => 'engineer']);
        $query_lic = \common\models\EngineerLicences::find()->where(['engineer_id' => $id]);
        $query = \common\models\Projects::find()->where(['engineer_id' => $id])->andWhere('visible=1 and status="active"');
        $query_eng = \common\models\Engineers::find()->where([]);

        return $this->render('view', [
            'model' => $model,
            'engineerFiles' => new ActiveDataProvider([
                'query' => $query_files,
            ]),
            'engineerLicences' => new ActiveDataProvider([
                'query' => $query_lic,
            ]),
            'projects' => new ActiveDataProvider([
                'query' => $query,
            ]),
            'engineers' => new ActiveDataProvider([
                'query' => $query_eng->orderBy(new \yii\db\Expression('rand()'))->limit(7),
            ]),
        ]);
    }

    /**
     * Creates a new Engineers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Engineers();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
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
     * Updates an existing Engineers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '//dashboard';
        
        $model = $this->findModel($id);
        if(\Yii::$app->user->can('updateOwnEngineerProfile', ['engineer'=>$model])){
            if ($model->load(Yii::$app->request->post())) {
                $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
                $model->coverFile = UploadedFile::getInstance($model, 'coverFile');
                $model->signatureFile = UploadedFile::getInstance($model, 'signatureFile');
                
                if($model->save()){
                    if ($model->signatureFile) {
                        $model->signFile ? unlink(\Yii::getAlias('images/legal_files/signatures/'.$model->signFile->name)) : null;
                        $filesgn = $model->signFile ?: null;
                        $imagesignFile = $model->uploadSign();
                        $model->signature = $imagesignFile;
                        $model->save();
                        $filesgn ? $filesgn->delete() : null;
                    } 
                    if ($model->avatarFile) {
                        $model->aFile ? unlink(\Yii::getAlias('images/profiles/'.$model->aFile->name)) : null;
                        $filea = $model->aFile ?: null;
                        $imageavatarFile = $model->uploadAvatar();
                        $model->avatar = $imageavatarFile;
                        $model->save();
                        $filea ? $filea->delete() : null;
                    } 
                    if ($model->coverFile) {
                        $model->cFile ? unlink(\Yii::getAlias('images/profiles/'.$model->cFile->name)) : null;
                        $filec = $model->cFile ?: null;
                        $imagecoverFile = $model->uploadÇover();
                        $model->cover_photo = $imagecoverFile;
                        $model->save();
                        $filec ? $filec->delete() : null;
                    }                    
                    return $this->redirect(['/home']);
                }                    
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('Nemate prava da pristupite ovoj stranici.');
        }
    }

    /**
     * Deletes an existing Engineers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->aFile ? unlink(\Yii::getAlias('images/profiles/'.$model->aFile->name)) : null;
        $model->cFile ? unlink(\Yii::getAlias('images/profiles/'.$model->cFile->name)) : null;
        $this->findModel($id)->delete();

        return $this->redirect(['/user/security/home', 'username'=>$model->user->username]);
    }*/

    /**
     * Finds the Engineers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Engineers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Engineers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
