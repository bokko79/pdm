<?php

/*
 * This file is part of the Servicemapp project.
 *
 * (c) Servicemapp project <http://github.com/bokko79/servicemapp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\controllers;

use dektrium\user\Finder;
use common\models\RegistrationForm;
use dektrium\user\models\ResendForm;
use dektrium\user\models\User;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use dektrium\user\controllers\RegistrationController as RegController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationController extends RegController
{
    use AjaxValidationTrait;
    use EventTrait;

    /**
     * Event is triggered after creating RegistrationForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_REGISTER = 'beforeRegister';

    /**
     * Event is triggered after successful registration.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_REGISTER = 'afterRegister';

    /**
     * Event is triggered before connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONNECT = 'beforeConnect';

    /**
     * Event is triggered after connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONNECT = 'afterConnect';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONFIRM = 'beforeConfirm';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONFIRM = 'afterConfirm';

    /**
     * Event is triggered after creating ResendForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_RESEND = 'beforeResend';

    /**
     * Event is triggered after successful resending of confirmation email.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_RESEND = 'afterResend';

    /**
     * Event is triggered after logging user in.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_LOGIN = 'afterLogin';

    /** @var Finder */
    protected $finder;

    /**
     * @param string           $id
     * @param \yii\base\Module $module
     * @param Finder           $finder
     * @param array            $config
     */
    public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $finder, $config);
    }

    // event init
    public function init()
    {
        $this->on(self::EVENT_AFTER_REGISTER, [$this, 'afterRegister']);
        $this->on(self::EVENT_AFTER_CONFIRM, [$this, 'afterConfirm']);
        $this->on(self::EVENT_AFTER_LOGIN, ['\frontend\controllers\SecurityController', 'updateLoginData']);
        $this->on(self::EVENT_AFTER_LOGIN, ['\frontend\controllers\SecurityController', 'afterLogin']);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['register-client'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['register',/* 'register-client',*/ 'connect'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['confirm', 'resend'], 'roles' => ['?', '@']],
                    ['allow' => true, 'actions' => ['register-licence', 'register-signature', 'register-practice'], 'roles' => ['engineer']],
                ],
            ],
        ];
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {
        $this->layout= '../../../../../frontend/views/layouts/blank';

        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = \Yii::createObject(RegistrationForm::className());
        $location = new \common\models\Locations();
        $engineer = new \common\models\Engineers();
        //$engineer_licence = new \common\models\EngineerLicences();
        //$engineer_signature = new \common\models\LegalFiles();
        //$practice_signature = new \common\models\LegalFiles();
        //$practice_stamp = new \common\models\LegalFiles();
        //$practice = new \common\models\Practices();
        $practice_engineer = new \common\models\PracticeEngineers();
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->request->post())/* && $location->load(\Yii::$app->request->post())*/ && $model->register() /*&& $location->save() */and $engineer->load(\Yii::$app->request->post())) {

            $user = \dektrium\user\models\User::findOne(['username'=>$event->form->username, 'email'=>$event->form->email]);

            if ($user) {
                $engineer->user_id = $user->id;
                $engineer->email = $user->email;
                $engineer->signatureFile = UploadedFile::getInstance($engineer, 'signatureFile');
                if($engineer->save()){
                    if ($engineer->signatureFile) {
                        $imagecoverFile = $engineer->uploadSign();
                        $engineer->signature = $imagecoverFile;
                        $engineer->save();
                    } 
                    //if($engineer->expertees_id!=31){ // ako nije tehničar, onda ima licencu i potpis
                        /*if($engineer_licence->load(\Yii::$app->request->post())){
                            $engineer_licence->engineer_id = $engineer->user_id;
                            $engineer_licence->stampFile = UploadedFile::getInstance($engineer_licence, 'stampFile');
                            if($engineer_licence->save()){            
                                if ($engineer_licence->stampFile) {
                                    $imagestampFile = $engineer_licence->uploadStampFile();
                                    $engineer_licence->stamp_id = $imagestampFile;
                                }                
                                $engineer_licence->save();
                            }
                        }
                        if($engineer_signature->load(\Yii::$app->request->post())){
                            $engineer_signature->entity_id = $engineer->user_id;
                            $engineer_signature->entity = 'engineer';
                            $engineer_signature->type = 'signature'; 
                            $engineer_signature->docFile = UploadedFile::getInstance($engineer_signature, 'docFile');
                            if($engineer_signature->save()){
                                if ($engineer_signature->docFile) {
                                    $image = $engineer_signature->uploadFiles();
                                    $engineer_signature->file_id = $image;
                                    $engineer_signature->save();
                                }
                            } 
                        }*/
                        /*if($model->practice_join==0 and $practice->load(\Yii::$app->request->post()) and $practice_engineer->load(\Yii::$app->request->post())){
                            $practice->engineer_id = $engineer->user_id;
                            $practice->email = $engineer->email;
                            $practice->phone = $engineer->phone;
                            $practice->location_id = $location->id;
                            if($practice->save()){
                                /*if($practice_signature->load(\Yii::$app->request->post())){
                                    $practice_signature->entity_id = $practice->engineer_id;
                                    $practice_signature->entity = 'practice';
                                    $practice_signature->type = 'signature'; 
                                    $practice_signature->docFile = UploadedFile::getInstance($practice_signature, 'docFile');
                                    if($practice_signature->save()){
                                        if ($practice_signature->docFile) {
                                            $image = $practice_signature->uploadFiles();
                                            $practice_signature->file_id = $image;
                                            $practice_signature->save();
                                        }
                                    } 
                                }
                                if($practice_stamp->load(\Yii::$app->request->post())){
                                    $practice_stamp->entity_id = $engineer->user_id;
                                    $practice_stamp->entity = 'practice';
                                    $practice_stamp->type = 'stamp'; 
                                    $practice_stamp->docFile = UploadedFile::getInstance($practice_stamp, 'docFile');
                                    if($practice_stamp->save()){
                                        if ($practice_stamp->docFile) {
                                            $image = $practice_stamp->uploadFiles();
                                            $practice_stamp->file_id = $image;
                                            $practice_stamp->save();
                                        }
                                    } 
                                }*/
                                /*$practice_engineer->practice_id = $practice->engineer_id;
                                $practice_engineer->engineer_id = $engineer->user_id;
                                $practice_engineer->position = 'direktor';
                                $practice_engineer->status = 'joined';
                                $practice_engineer->time = time();
                                $practice_engineer->save();
                            }                                
                        }*/
                    //}
                    if($model->practice_join==1 /*and $practice_engineer->load(\Yii::$app->request->post())*/){
                        $practice_engineer->engineer_id = $engineer->user_id;
                        $practice_engineer->practice_id = $model->practice_id;
                        $practice_engineer->position = 'zaposleni';
                        $practice_engineer->status = 'to_join';
                        $practice_engineer->time = time();
                        $practice_engineer->save();
                    }                                                                   
                }

                $user->role = 'engineer';
                $user->save();
                // the following three lines were added:
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('engineer');
                $auth->assign($authorRole, $user->getId());

                \Yii::$app->user->switchIdentity($user);
            }            
            $this->trigger(self::EVENT_AFTER_REGISTER, $event);
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);

            //return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
            return $this->redirect(['/user/registration/register-licence', 'EngineerLicences[engineer_id]' => $engineer->user_id, 'practice'=>$model->practice_join==0 ? 1 : 0]);
        }

        return $this->render('register', [
            'model'  => $model,
            'module' => $this->module,
            'location' => $location,
            'engineer' => $engineer,
            //'engineer_licence' => $engineer_licence,
            //'practice' => $practice,
            //'practice_engineer' => $practice_engineer,
            //'engineer_signature' => $engineer_signature,
            //'practice_signature' => $practice_signature,
            //'practice_stamp' => $practice_stamp,
        ]);
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegisterLicence()
    {
        $this->layout= '../../../../../frontend/views/layouts/blank';

        $model = new \common\models\EngineerLicences();
        if($el = \Yii::$app->request->get('EngineerLicences')){
            $model->engineer_id = !empty($el['engineer_id']) ? $el['engineer_id'] : null;
        }
        $p = \Yii::$app->request->get('practice');
        if ($model->load(\Yii::$app->request->post())) {
            $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
            if($model->save()){            
                if ($model->stampFile) {
                    $imagestampFile = $model->uploadStampFile();
                    $model->stamp_id = $imagestampFile;
                    $model->save();
                }
                if($p==1){
                    return $this->redirect(['/user/registration/register-practice', 'Practices[engineer_id]' => $model->engineer_id]);
                } else {
                    return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
                }
                //return $this->redirect(['/user/registration/register-signature', 'LegalFiles[entity_id]' => $model->engineer_id, 'LegalFiles[entity]' => 'engineer', 'LegalFiles[type]' => 'signature', 'practice' => $p]);
            } 
        } else {
            return $this->render('register-licence', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegisterSignature()
    {
        $this->layout= '../../../../../frontend/views/layouts/blank';

        $model = new \common\models\LegalFiles();
        if($lf = \Yii::$app->request->get('LegalFiles')){
            $model->entity_id = !empty($lf['entity_id']) ? $lf['entity_id'] : null;
            $model->entity = !empty($lf['entity']) ? $lf['entity'] : null;
            $model->type = !empty($lf['type']) ? $lf['type'] : null;  
        }
        $p = \Yii::$app->request->get('practice');
        if ($model->load(\Yii::$app->request->post())) {
            $model->docFile = UploadedFile::getInstance($model, 'docFile');
            if($model->save()){
                if ($model->docFile) {
                    $image = $model->uploadFiles();
                    $model->file_id = $image;
                    $model->save();
                }                    
                //return $this->redirect([''.$model->entity.'s/view', 'id' => $model->entity_id, '#'=>'w4-tab3']);
                if($p==1){
                    return $this->redirect(['/user/registration/register-practice', 'Practices[engineer_id]' => $model->entity_id]);
                } else {
                    return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
                }
                
            }                    
        } else {
            return $this->render('register-signature', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegisterPractice()
    {
        $this->layout= '../../../../../frontend/views/layouts/blank';

        $model = new \common\models\Practices();
        $location = new \common\models\Locations();
        if($p = \Yii::$app->request->get('Practices')){
            $model->engineer_id = !empty($p['engineer_id']) ? $p['engineer_id'] : null;
        }
        if ($model->load(\Yii::$app->request->post()) and $location->load(\Yii::$app->request->post()) and $location->save()) {
            $engineer = \common\models\Engineers::findOne($model->engineer_id);
            $model->location_id = $location->id;
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
            $model->stampFile = UploadedFile::getInstance($model, 'stampFile');
            $model->email = $engineer->email;
            $model->phone = $engineer->phone; 
            if($model->save()){
                if ($model->avatarFile) {
                    $imageavatarFile = $model->uploadAvatar();
                    $model->avatar = $imageavatarFile;
                    $model->save();
                } 
                if ($model->stampFile) {
                    $imagecoverFile = $model->uploadStamp();
                    $model->stamp = $imagecoverFile;
                    $model->save();
                }
                $practice_engineer = new \common\models\PracticeEngineers();
                $practice_engineer->practice_id = $model->engineer_id;
                $practice_engineer->engineer_id = \Yii::$app->user->id;
                $practice_engineer->position = 'direktor';
                $practice_engineer->save();

                return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
            }
        } else {
            return $this->render('register-practice', [
                'model' => $model,
                'location' => $location,
            ]);
        }
    }

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegisterClient()
    {
        $this->layout= '../../../../../frontend/views/layouts/blank';
        //if(!\Yii::$app->user->can('client')){
            if (!$this->module->enableRegistration) {
                throw new NotFoundHttpException();
            }

            /** @var RegistrationForm $model */
            $model = \Yii::createObject(RegistrationForm::className());
            $location = new \common\models\Locations();
            //$client = new \common\models\Clients();
            $event = $this->getFormEvent($model);

            $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

            $this->performAjaxValidation($model);

            if ($model->load(\Yii::$app->request->post()) && $model->register() and $location->load(\Yii::$app->request->post()) && $location->save()/* and $client->load(\Yii::$app->request->post())*/) {
                                
                if ($user = \dektrium\user\models\User::findOne(['username'=>$event->form->username, 'email'=>$event->form->email])) {
                   /*$client->user_id = $user->id;
                    $client->location_id = $location->id;
                    $client->email = $user->email;
                    $client->save();*/

                    $user->role = 'user';
                    $user->save();
                    // the following three lines were added:
                    $auth = \Yii::$app->authManager;
                    $authorRole = $auth->getRole('user');
                    $auth->assign($authorRole, $user->getId());

                    \Yii::$app->user->switchIdentity($user);

                    $this->trigger(self::EVENT_AFTER_REGISTER, $event);
                    $this->trigger(self::EVENT_AFTER_LOGIN, $event);

                   //\Yii::$app->response->redirect(\Yii::$app->user->returnUrl);
                    return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
                }                   

            } else {
                return $this->render('register-client', [
                    'model'  => $model,
                    'module' => $this->module,
                    'location' => $location,
                   // 'client' => $client,
                ]);
            }            
        /*} else {
            return $this->redirect(['/requests/create']);
        }*/
    }

    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->findModel($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        //$event = $this->getUserEvent($user);

        //$this->trigger(self::EVENT_BEFORE_CONFIRM, $event);

        $user->attemptConfirmation($code);

        //$this->trigger(self::EVENT_AFTER_CONFIRM, $event);

        return $this->redirect(['/user/security/home', 'username' => $user->username]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($model = \common\models\UserAccount::find()->where('id='.$id)->one()) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the LegalFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LegalFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEngineerById($id)
    {
        if (($model = \common\models\Engineers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function afterRegister($event){        
        return;
    }

    public function afterConfirm($event){        
        return;
    }


}