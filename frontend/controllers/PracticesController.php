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
use yii\web\UploadedFile;

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
                'only' => ['update'],
                'rules' => [
                    [
                        'actions' => ['update'],
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
        //$searchModel->user_id = Yii::$app->user->id;
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
        $this->layout = 'profile';
        
        $model = $this->findModel($id);
        $query_pe = \common\models\PracticeEngineers::find()->where(['practice_id' => $id]);
        $query_pp = \common\models\PracticePartners::find()->where(['practice_id' => $id])->orWhere(['partner_id' => $id]);
        $query = \common\models\Projects::find()->where('practice_id='. $id.' or control_practice_id='.$id);
        $query_pr = \common\models\Practices::find();

        /* \Yii::$app->mailer->compose(['html' => '/user/mail/new_password', 'text' => '/user/mail/text/new_password'], ['user' => $model->engineer->user])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo('bojan.grozdanic@gmail.com')
                ->setSubject('Novi pregled firme' )
                ->send();*/


        return $this->render('view', [
            'model' => $model,
            'practiceEngineers' => new ActiveDataProvider([
                'query' => $query_pe,
            ]),
            'practicePartners' => new ActiveDataProvider([
                'query' => $query_pp,
            ]),
            'projects' => new ActiveDataProvider([
                'query' => $query->limit(3),
                'pagination' => false,
            ]),
            'practices' => new ActiveDataProvider([
                'query' => $query_pr->orderBy(new \yii\db\Expression('rand()'))->limit(3),
                'pagination' => false,
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
        if($p = Yii::$app->request->get('Practices')){
            $model->engineer_id = !empty($p['engineer_id']) ? $p['engineer_id'] : null;
        }
        if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {
            $model->engineer_id = Yii::$app->user->id;
            $model->location_id = $location->id;
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
            $model->coverFile = UploadedFile::getInstance($model, 'coverFile');
            $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
            $model->memoFile = UploadedFile::getInstance($model, 'memoFile');
            if($model->save()){
                if ($model->avatarFile) {
                    $imageavatarFile = $model->uploadAvatar();
                    $model->avatar = $imageavatarFile;
                    $model->save();
                } 
                if ($model->coverFile) {
                    $imagecoverFile = $model->uploadÇover();
                    $model->cover_photo = $imagecoverFile;
                    $model->save();
                }
                if ($model->stampFile) {
                    $imagestampFile = $model->uploadStamp();
                    $model->stamp = $imagestampFile;
                    $model->save();
                }
                if ($model->memoFile) {
                    $imagememoFile = $model->uploadMemo();
                    $model->memo = $imagememoFile;
                    $model->save();
                }
                $practice_engineer = new \common\models\PracticeEngineers();
                $practice_engineer->practice_id = $model->engineer_id;
                $practice_engineer->engineer_id = Yii::$app->user->id;
                $practice_engineer->position = 'direktor';
                $practice_engineer->save();

                return $this->redirect(['/user/settings/practice-setup']);
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
        $this->layout = '//dashboard';

        $model = $this->findModel($id);
        $location = $model->location;
        if(\Yii::$app->user->can('updateOwnPractice', ['practice_engineer'=>$model])){
            if ($model->load(Yii::$app->request->post()) and $location->load(Yii::$app->request->post()) and $location->save()) {
                $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
                $model->coverFile = UploadedFile::getInstance($model, 'coverFile');
                $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
                $model->memoFile = UploadedFile::getInstance($model, 'memoFile');
                if($model->save()){
                    if ($model->avatarFile) {
                        $model->aFile ? unlink(\Yii::getAlias('images/profiles/'.$model->aFile->name)) : null;
                        $imageavatarFile = $model->uploadAvatar();
                        $model->avatar = $imageavatarFile;
                        $model->save();
                    } 
                    if ($model->coverFile) {
                        $model->cFile ? unlink(\Yii::getAlias('images/profiles/'.$model->cFile->name)) : null;
                        $imagecoverFile = $model->uploadÇover();
                        $model->cover_photo = $imagecoverFile;
                        $model->save();
                    }
                    if ($model->stampFile) {
                        $imagestampFile = $model->uploadStamp();
                        $model->stamp = $imagestampFile;
                        $model->save();
                    }
                    if ($model->memoFile) {
                        $imagememoFile = $model->uploadMemo();
                        $model->memo = $imagememoFile;
                        $model->save();
                    }                   
                    return $this->redirect(['/user/settings/practice-setup']);
                } 
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
     * Deletes an existing Practices model.
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

        return $this->redirect(['user/settings/practice-setup']);
    }*/

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
