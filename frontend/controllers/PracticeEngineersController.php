<?php

namespace frontend\controllers;

use Yii;
use common\models\PracticeEngineers;
use common\models\PracticeEngineersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PracticeEngineersController implements the CRUD actions for PracticeEngineers model.
 */
class PracticeEngineersController extends Controller
{
    public $layout = 'dashboard';

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
     * Lists all PracticeEngineers models.
     * @return mixed
     */
    public function actionIndex()
    {
        if($id = Yii::$app->request->get('id')){
            $practice = $id ? $this->findPracticeById($id) : null;
        }

        if($practice){
            if($practice->practiceEngineers){
                return $this->redirect(['update', 'id' => $practice->practiceEngineers[0]->id]);
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
     * Displays a single PracticeEngineers model.
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
     * Creates a new PracticeEngineers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PracticeEngineers();
        if($pe = Yii::$app->request->get('PracticeEngineersSearch')){
            $model->practice_id = !empty($pe['practice_id']) ? $pe['practice_id'] : null;
            $model->engineer_id = !empty($pe['engineer_id']) ? $pe['engineer_id'] : null;
            $model->position = !empty($pe['position']) ? $pe['position'] : 'zaposleni';
            $model->status = !empty($pe['status']) ? $pe['status'] : null;
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->user->id == $model->practice_id){
                // status i email inženjeru
                $model->status = 'invited';
                $model->position = 'zaposleni';
                $model->save();
                \Yii::$app->mailer->compose(['html' => '/user/mail/to_join'], ['model'=>$model, 'email'=>$model->engineer->email])
                    ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                    ->setTo($model->engineer->email)
                    ->setSubject($model->practice->name. ': Poziv na učlanjenje na Masterplan.rs')
                    ->send();
            } elseif(Yii::$app->user->id == $model->engineer_id) {
                $model->status = 'to_join';
                $model->save();
                \Yii::$app->mailer->compose(['html' => '/user/mail/invited'], ['model'=>$model, 'email'=>$model->practice->email])
                    ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                    ->setTo($model->practice->email)
                    ->setSubject($model->engineer->name. ': Poziv na učlanjenje u Vaše preduzeće na Masterplan.rs')
                    ->send();
            }            
            return $this->redirect(['/user/settings/practice-setup', '#'=>'w8-tab1']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PracticeEngineers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/user/settings/practice-setup', '#'=>'w8-tab1']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PracticeEngineers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionConfirm($id)
    {
        if ($model = $this->findModel($id)) {
            $model->status = 'joined';
            $model->save();
            /*\Yii::$app->mailer->compose(['html' => '/user/mail/membership_confirm'], ['model'=>$model, 'email'=>$model->engineer->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo([$model->engineer->email, $model->practice->email])
                ->setSubject('Potvrda članstva na Masterplan.rs')
                ->send();*/
            return $this->redirect(['/home']);
        }
        return $this->redirect(['/']);
    }

    /**
     * Deletes an existing PracticeEngineers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/user/settings/practice-setup', '#'=>'w8-tab1']);
    }

    /**
     * Finds the PracticeEngineers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PracticeEngineers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PracticeEngineers::findOne($id)) !== null) {
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
