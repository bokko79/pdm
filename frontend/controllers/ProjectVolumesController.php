<?php

namespace frontend\controllers;

use Yii;
use common\models\ProjectVolumes;
use common\models\ProjectVolumesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * ProjectVolumesController implements the CRUD actions for ProjectVolumes model.
 */
class ProjectVolumesController extends Controller
{
    public $layout = 'project';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'update', 'delete', 'create', 'index',],
                'rules' => [
                    [
                        'actions' => ['view', 'update', 'create', 'index', 'delete'],
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
     * Lists all ProjectVolumes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectVolumesSearch();

        if($p = Yii::$app->request->get('ProjectVolumesSearch')){
            $searchModel->project_id = !empty($p['project_id']) ? $p['project_id'] : null;
            $model = $this->findProjectById($searchModel->project_id);
        }
        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])){
            if(\Yii::$app->request->post('step_form')){
                $model->setup_status = 'address';
                $model->save();
                return $this->redirect($model->setupRedirect);
            } else {
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        }
    }

    /**
     * Displays a single ProjectVolumes model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {     
    	$searchModel = new ProjectVolumesSearch(); 
        $model = $this->findModel($id);
        $searchModel->project_id = $model->project_id; 
        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])):
            $model->dataReqFlash($model->dataReqs());        

            return $this->render('view', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
            ]);
        else:
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        endif;
    }

    /**
     * Creates a new ProjectVolumes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $searchModel = new ProjectVolumesSearch();
        $model = new ProjectVolumes();
        if($p = Yii::$app->request->get('ProjectVolumesSearch')){
            $model->project_id = isset($p['project_id']) ? $p['project_id'] : null;
            $model->volume_id = isset($p['volume_id']) ? $p['volume_id'] : null;
            $project = $this->findProjectById($model->project_id);
            $searchModel->project_id = isset($p['project_id']) ? $p['project_id'] : null;
        }

        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$project])):
            if ($model->load(Yii::$app->request->post())) {
                $model->time = time();
                $engLic = $this->findEngineerLicence($model->engineer_licence_id);
                $model->engineer_id = $engLic->engineer_id;
                if($model->name==null){
                    $volume = $this->findVolumeById($model->volume_id);
                    $model->name = $volume->name;
                }
                if($model->control_engineer_licence_id){
                    $engLicC = $this->findEngineerLicence($model->control_engineer_licence_id);
                    $model->control_engineer_id = $engLic->engineer_id;
                }
                if($model->save()){
                    $this->generateDrawings($model);
                    $this->sendMail($model);                        
                    return $this->redirect(['index', 'ProjectVolumesSearch[project_id]' => $model->project_id]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
                ]);
            }
                
        else:
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        endif;
    }

    /**
     * Updates an existing ProjectVolumes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$searchModel = new ProjectVolumesSearch(); 
    	 
        $model = $this->findModel($id);
        $searchModel->project_id = $model->project_id; 

        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])):
            if ($model->load(Yii::$app->request->post())) {
                $engLic = $this->findEngineerLicence($model->engineer_licence_id);
                $model->engineer_id = $engLic->engineer_id;
                if($model->control_engineer_licence_id){
                    $engLicC = $this->findEngineerLicence($model->control_engineer_licence_id);
                    $model->control_engineer_id = $engLic->engineer_id;
                }
                if($model->save()){
                    return $this->redirect(['index', 'ProjectVolumesSearch[project_id]' => $model->project_id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
            ]);
        else:
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        endif;
    }

    /**
     * Deletes an existing ProjectVolumes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        // access control
        if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model->project])):

            // delete all the drawings   
            if($drawings = $model->projectVolumeDrawings){
                foreach($drawings as $drawing){
                    $drawing->delete();
                }
            }
            $model->delete();
        return $this->redirect(['/project-volumes/index', 'ProjectVolumesSearch[project_id]' => $model->project_id]);
        else:
            return $this->redirect([\Yii::$app->user->isGuest ? '/' : '/home']);
        endif;
    }

    public function actionEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\EngineerLicences::find()->where('engineer_id='.$cat_id)->all();
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->id;
                    $out[$key]['name'] = $r->engineer->name.' - '.$r->no;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionControlEngineers() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $res = \common\models\EngineerLicences::find()->where('engineer_id='.$cat_id)->all();
                foreach($res as $key=>$r){
                    $out[$key]['id'] = $r->id;
                    $out[$key]['name'] = $r->engineer->name.' - '.$r->no;
                }
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>$out[0]['id']]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectVolumes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVolumeById($id)
    {
        if (($model = \common\models\Volumes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
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
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEngineerLicence($id)
    {
        if (($model = \common\models\EngineerLicences::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function sendMail($model)
    {
        if($model->engineer_id!=Yii::$app->user->id){
            \Yii::$app->mailer->compose(['html' => '/user/mail/new_volume'], ['model'=>$model, 'email'=>$model->engineer->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($model->engineer->email)
                ->setSubject('Nova sveska projekta '. $model->project->code)
                ->send();
        }
        if($model->practice_id!=Yii::$app->user->id){
            \Yii::$app->mailer->compose(['html' => '/user/mail/new_volume'], ['model'=>$model, 'email'=>$model->practice->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($model->practice->email)
                ->setSubject('Nova sveska projekta '. $model->project->code)
                ->send();
        }
        if($model->control_engineer_id and $model->control_engineer_id!=Yii::$app->user->id){
            \Yii::$app->mailer->compose(['html' => '/user/mail/new_volume'], ['model'=>$model, 'email'=>$model->controlEngineer->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($model->controlEngineer->email)
                ->setSubject('Nova sveska projekta '. $model->project->code)
                ->send();
        }
        if($model->control_practice_id and $model->control_practice_id!=Yii::$app->user->id){
            \Yii::$app->mailer->compose(['html' => '/user/mail/new_volume'], ['model'=>$model, 'email'=>$model->controlPractice->email])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($model->controlPractice->email)
                ->setSubject('Nova sveska projekta '. $model->project->code)
                ->send();
        }
    }

    /**
     * Finds the ProjectVolumes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProjectVolumes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function generateDrawings($volume)
    {
        if($volume->volume->type=='projekat'){
            // situacije
            $draw_sit = new \common\models\ProjectVolumeDrawings();
            $draw_sit->project_volume_id = $volume->id;
            $draw_sit->type = 'situacija';
            $draw_sit->number = '001';
            $draw_sit->name = 'situacija';
            $draw_sit->title = 'situacija';
            $draw_sit->print_title = 1;
            $draw_sit->scale = 200;
            $draw_sit->save();

            // situacije
            $draw_sith = new \common\models\ProjectVolumeDrawings();
            $draw_sith->project_volume_id = $volume->id;
            $draw_sith->type = 'situacija';
            $draw_sith->number = '002';
            $draw_sith->name = 'sinhron plan';
            $draw_sith->title = 'sinhron plan vodova';
            $draw_sith->print_title = 1;
            $draw_sith->scale = 200;
            $draw_sith->save();

            // osnove
            $draw_ot = new \common\models\ProjectVolumeDrawings();
            $draw_ot->project_volume_id = $volume->id;
            $draw_ot->type = 'osnova';
            $draw_ot->number = '101';
            $draw_ot->name = 'osnova temelja';
            $draw_ot->title = 'osnova temelja';
            $draw_ot->print_title = 1;
            $draw_ot->scale = 100;
            $draw_ot->save();

            $building = $volume->project->projectBuilding ? $volume->project->projectBuilding : $volume->project->projectExBuilding;
            if($storeys = $building->projectBuildingStoreys){
                foreach($storeys as $key=>$storey){
                    // osnove
                    $draw_o[$key] = new \common\models\ProjectVolumeDrawings();
                    $draw_o[$key]->project_volume_id = $volume->id;
                    $draw_o[$key]->project_building_storey_id = $storey->id;
                    $draw_o[$key]->type = 'osnova';
                    $draw_o[$key]->number = strval($key+102);
                    $draw_o[$key]->name = 'osnova '.$storey->name;
                    $draw_o[$key]->title = 'osnova '.$storey->name;
                    $draw_o[$key]->print_title = 1;
                    $draw_o[$key]->scale = 100;
                    $draw_o[$key]->save();
                }
            }
            // osnove kk
            $draw_k = new \common\models\ProjectVolumeDrawings();
            $draw_k->project_volume_id = $volume->id;
            $draw_k->type = 'osnova';
            $draw_k->number = strval(count($storeys)+102);
            $draw_k->name = 'osnova krovne konstrukcije';
            $draw_k->title = 'osnova krovne konstrukcije';
            $draw_k->print_title = 1;
            $draw_k->scale = 100;
            $draw_k->save();

            // osnove kr
            $draw_kr = new \common\models\ProjectVolumeDrawings();
            $draw_kr->project_volume_id = $volume->id;
            $draw_kr->type = 'osnova';
            $draw_kr->number = strval(count($storeys)+103);
            $draw_kr->name = 'osnova krovnih ravni';
            $draw_kr->title = 'osnova krovnih ravni';
            $draw_kr->print_title = 1;
            $draw_kr->scale = 100;
            $draw_kr->save();

            // presek a-a
            $draw_p = new \common\models\ProjectVolumeDrawings();
            $draw_p->project_volume_id = $volume->id;
            $draw_p->type = 'presek';
            $draw_p->number = '201';
            $draw_p->name = 'presek A-A';
            $draw_p->title = 'presek A-A';
            $draw_p->print_title = 1;
            $draw_p->scale = 100;
            $draw_p->save();

            // presek b-b
            $draw_pb = new \common\models\ProjectVolumeDrawings();
            $draw_pb->project_volume_id = $volume->id;
            $draw_pb->type = 'presek';
            $draw_pb->number = '202';
            $draw_pb->name = 'presek B-B';
            $draw_pb->title = 'presek B-B';
            $draw_pb->print_title = 1;
            $draw_pb->scale = 100;
            $draw_pb->save();

            // izgled
            $draw_i = new \common\models\ProjectVolumeDrawings();
            $draw_i->project_volume_id = $volume->id;
            $draw_i->type = 'izgled';
            $draw_i->number = '301';
            $draw_i->name = 'izgledi fasada';
            $draw_i->title = 'izgledi fasada';
            $draw_i->print_title = 1;
            $draw_i->scale = 100;
            $draw_i->save();
        }  else if($volume->volume->type=='izvod'){
        // situacije
            $draw_sit = new \common\models\ProjectVolumeDrawings();
            $draw_sit->project_volume_id = $volume->id;
            $draw_sit->type = 'situacija';
            $draw_sit->number = '001';
            $draw_sit->name = 'situacija sa osnovom krova';
            $draw_sit->title = 'situacioni plan sa osnovom krova';
            $draw_sit->print_title = 1;
            $draw_sit->scale = 200;
            $draw_sit->save();

            $draw_sit2 = new \common\models\ProjectVolumeDrawings();
            $draw_sit2->project_volume_id = $volume->id;
            $draw_sit2->type = 'situacija';
            $draw_sit2->number = '002';
            $draw_sit2->name = 'situacija sa osnovom prizemlja';
            $draw_sit2->title = 'situaciono-nivelacioni plan sa osnovom prizemlja';
            $draw_sit2->print_title = 1;
            $draw_sit2->scale = 200;
            $draw_sit2->save();

            $draw_sit3 = new \common\models\ProjectVolumeDrawings();
            $draw_sit3->project_volume_id = $volume->id;
            $draw_sit3->type = 'situacija';
            $draw_sit3->number = '003';
            $draw_sit3->name = 'situacija sa saobraćajnim rešenjem';
            $draw_sit3->title = 'situaciono-nivelacioni plan sa prikazom saobraćajnog rešenja';
            $draw_sit3->print_title = 1;
            $draw_sit3->scale = 200;
            $draw_sit3->save();

            $draw_sit4 = new \common\models\ProjectVolumeDrawings();
            $draw_sit4->project_volume_id = $volume->id;
            $draw_sit4->type = 'situacija';
            $draw_sit4->number = '004';
            $draw_sit4->name = 'sinhron plan instalacija';
            $draw_sit4->title = 'situacioni plan sa prikazom sinhron-plana instalacija';
            $draw_sit4->print_title = 1;
            $draw_sit4->scale = 200;
            $draw_sit4->save();

            $draw_sit5 = new \common\models\ProjectVolumeDrawings();
            $draw_sit5->project_volume_id = $volume->id;
            $draw_sit5->type = 'osnova';
            $draw_sit5->number = '101';
            $draw_sit5->name = 'osnova';
            $draw_sit5->title = 'osnova';
            $draw_sit5->print_title = 1;
            $draw_sit5->scale = 100;
            $draw_sit5->save();

        } else if($volume->volume->type=='ozakonjenje'){
        // situacije
            // situacije
            $draw_sit = new \common\models\ProjectVolumeDrawings();
            $draw_sit->project_volume_id = $volume->id;
            $draw_sit->type = 'situacija';
            $draw_sit->number = '001';
            $draw_sit->name = 'situacija';
            $draw_sit->title = 'situacija';
            $draw_sit->print_title = 1;
            $draw_sit->scale = 200;
            $draw_sit->save();

            $building = $volume->project->projectBuilding ? $volume->project->projectBuilding : $volume->project->projectExBuilding;
            if($storeys = $building->projectBuildingStoreys){
                foreach($storeys as $key=>$storey){
                    // osnove
                    $draw_o[$key] = new \common\models\ProjectVolumeDrawings();
                    $draw_o[$key]->project_volume_id = $volume->id;
                    $draw_o[$key]->project_building_storey_id = $storey->id;
                    $draw_o[$key]->type = 'osnova';
                    $draw_o[$key]->number = strval($key+101);
                    $draw_o[$key]->name = 'osnova '.$storey->name;
                    $draw_o[$key]->title = 'osnova '.$storey->name;
                    $draw_o[$key]->print_title = 1;
                    $draw_o[$key]->scale = 100;
                    $draw_o[$key]->save();
                }
            }

            // osnove kr
            $draw_kr = new \common\models\ProjectVolumeDrawings();
            $draw_kr->project_volume_id = $volume->id;
            $draw_kr->type = 'osnova';
            $draw_kr->number = strval(count($storeys)+103);
            $draw_kr->name = 'osnova krovnih ravni';
            $draw_kr->title = 'osnova krovnih ravni';
            $draw_kr->print_title = 1;
            $draw_kr->scale = 100;
            $draw_kr->save();

            // presek a-a
            $draw_p = new \common\models\ProjectVolumeDrawings();
            $draw_p->project_volume_id = $volume->id;
            $draw_p->type = 'presek';
            $draw_p->number = '201';
            $draw_p->name = 'presek A-A';
            $draw_p->title = 'presek A-A';
            $draw_p->print_title = 1;
            $draw_p->scale = 100;
            $draw_p->save();

            // presek b-b
            $draw_pb = new \common\models\ProjectVolumeDrawings();
            $draw_pb->project_volume_id = $volume->id;
            $draw_pb->type = 'presek';
            $draw_pb->number = '202';
            $draw_pb->name = 'presek B-B';
            $draw_pb->title = 'presek B-B';
            $draw_pb->print_title = 1;
            $draw_pb->scale = 100;
            $draw_pb->save();

            // izgled
            $draw_i = new \common\models\ProjectVolumeDrawings();
            $draw_i->project_volume_id = $volume->id;
            $draw_i->type = 'izgled';
            $draw_i->number = '301';
            $draw_i->name = 'izgledi fasada';
            $draw_i->title = 'izgledi fasada';
            $draw_i->print_title = 1;
            $draw_i->scale = 100;
            $draw_i->save();
        }
    }
}
