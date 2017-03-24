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
                    ['allow' => true, 'actions' => ['register-client'], 'roles' => ['?', 'engineer', 'user']],
                    ['allow' => true, 'actions' => ['register',/* 'register-client',*/ 'connect'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['confirm', 'resend'], 'roles' => ['?', '@']],
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
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = \Yii::createObject(RegistrationForm::className());
        $location = new \common\models\Locations();
        $engineer = new \common\models\Engineers();
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->request->post()) && $location->load(\Yii::$app->request->post()) && $model->register() && $location->save() and $engineer->load(\Yii::$app->request->post())) {

            $user = \dektrium\user\models\User::findOne(['username'=>$event->form->username, 'email'=>$event->form->email]);

            if ($user) {
                $engineer->user_id = $user->id;
                $engineer->email = $user->email;
                $engineer->save();

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

            return $this->redirect(['/user/security/home', 'username' => \Yii::$app->user->identity->username]);
        }

        return $this->render('register', [
            'model'  => $model,
            'module' => $this->module,
            'location' => $location,
            'engineer' => $engineer,
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
    public function actionRegisterClient()
    {
        if(!\Yii::$app->user->can('client')){
            if (!$this->module->enableRegistration) {
                throw new NotFoundHttpException();
            }

            /** @var RegistrationForm $model */
            $model = \Yii::createObject(RegistrationForm::className());
            $location = new \common\models\Locations();
            $client = new \common\models\Clients();
            $event = $this->getFormEvent($model);

            $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

            $this->performAjaxValidation($model);

            if ($model->load(\Yii::$app->request->post()) && $model->register() and $location->load(\Yii::$app->request->post()) && $location->save() and $client->load(\Yii::$app->request->post())) {
                                
                if ($user = \dektrium\user\models\User::findOne(['username'=>$event->form->username, 'email'=>$event->form->email])) {
                    $client->user_id = $user->id;
                    $client->location_id = $location->id;
                    $client->email = $user->email;
                    $client->save();

                    $user->role = 'client';
                    $user->save();
                    // the following three lines were added:
                    $auth = \Yii::$app->authManager;
                    $authorRole = $auth->getRole('client');
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
                    'client' => $client,
                ]);
            }            
        } else {
            return $this->redirect(['/requests/create']);
        }
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


    public function afterRegister($event){        
        return;
    }

    public function afterConfirm($event){        
        return;
    }
}