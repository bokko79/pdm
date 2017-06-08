<?php

namespace frontend\controllers;

use Yii;
use common\models\PracticePartners;
//use common\models\PracticeEngineersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PracticeEngineersController implements the CRUD actions for PracticeEngineers model.
 */
class PracticePartnersController extends Controller
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
            if($practice->practicePartners){
                return $this->redirect(['update', 'id' => $practice->practicePartners[0]->id]);
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
     * Creates a new PracticeEngineers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PracticePartners();
        if($pe = Yii::$app->request->get('PracticePartners')){
            $model->practice_id = !empty($pe['practice_id']) ? $pe['practice_id'] : null;
            $model->partner_id = !empty($pe['partner_id']) ? $pe['partner_id'] : null;
            
            // status i email inženjeru
            $model->status = 'invited';
            $model->time = time();
            $model->save();
            /*\Yii::$app->mailer->compose(['html' => '/user/mail/to_connect'], ['model'=>$model, 'email'=>$model->practice->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($model->practice->email)
                ->setSubject($model->practice->name. ': Poziv na učlanjenje na Masterplan.rs')
                ->send();*/
                      
            return $this->redirect(['/user/settings/practice-setup', '#'=>'w9-tab3']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
            return $this->redirect(['/user/settings/practice-setup', '#'=>'w9-tab3']);
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
            $model->status = 'partner';
            $model->time = time();
            $model->save();
            \Yii::$app->mailer->compose(['html' => '/user/mail/partnership_confirm'], ['model'=>$model, 'email'=>$model->practice->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo([/*$model->partner->email, */$model->practice->email])
                ->setSubject('Potvrda partnerstva na Masterplan.rs')
                ->send();
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
        if (($model = PracticePartners::findOne($id)) !== null) {
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
