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

use Yii;
use dektrium\user\Finder;
use common\models\SettingsForm;
use common\models\UserAccount;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;


/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SettingsController extends BaseSettingsController
{
    public $layout = '//dashboard';
    // event init
    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['services'],
                'rules' => [
                    [
                        'actions' => [
                            'practice-setup', 'account', 'document-setup', 'licence-setup', 
                            'portfolio-setup', 'document-client', 
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays page where user can update account settings (username, email or password).
     *
     * @return string|\yii\web\Response
     */
    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post())) {
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');

            if($model->save()){
                if ($model->avatarFile) {
                    $model->user->aFile ? unlink(\Yii::getAlias('images/profiles/'.$model->user->aFile->name)) : null;
                    $filea = $model->user->aFile ?: null;
                    $imageavatarFile = $model->uploadAvatar();
                    $model->avatar = $imageavatarFile;
                    $model->save();
                    $filea ? $filea->delete() : null;
                }                   
                \Yii::$app->session->setFlash('success', \Yii::t('user', 'Vaši podaci su uspešno ažurirani.'));
                $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
                return $this->refresh();
            }                
        }

        return $this->render('account', [
            'model' => $model,
            'user' => $model->user,
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionDocumentSetup()
    {
        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->engineer;
        $query_files = \common\models\LegalFiles::find()->where(['entity_id' => $model->user_id, 'entity' => 'engineer']);

        return $this->render('document-setup', [
            'model' => $model,
            'engineerFiles' => new ActiveDataProvider([
                'query' => $query_files,
            ]),
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionLicenceSetup()
    {
        $this->layout = '//dashboard';

        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->engineer;
        $query_lic = \common\models\EngineerLicences::find()->where(['engineer_id' => $model->user_id]);

        return $this->render('licence-setup', [
            'model' => $model,
            'engineerLicences' => new ActiveDataProvider([
                'query' => $query_lic,
            ]),
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionPracticeSetup()
    {
        $this->layout = '//dashboard';

        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->engineer;
        $practice = $model->practice;
        $clients = new \common\models\ClientsSearch();
        $clients->practice_id = $practice->engineer_id;
        $dataProvider = $clients->search(Yii::$app->request->queryParams);
        $query_pe = $practice ? \common\models\PracticeEngineers::find()->where(['practice_id' => $practice->engineer_id]) : null;
        $query_pp = $practice ? \common\models\PracticePartners::find()->where(['practice_id' => $practice->engineer_id])->orWhere(['partner_id' => $practice->engineer_id]) : null;

        return $this->render('practice-setup', [
            'model' => $model,
            'practice' => $practice,
            'practiceEngineers' => new ActiveDataProvider([
                'query' => $query_pe,
            ]),
            'practicePartners' => new ActiveDataProvider([
                'query' => $query_pp,
            ]),
            'clients' => $clients,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionPortfolioSetup()
    {
        $this->layout = '//dashboard';

        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->engineer;
        $practice = $model->practice;

        return $this->render('portfolio-setup', [
            'model' => $model,
            'practice' => $practice,
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionDocumentClient()
    {
        $this->layout = '//dashboard';
        
        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->client;

        return $this->render('document-client', [
            'model' => $model,
        ]);
    }
}
