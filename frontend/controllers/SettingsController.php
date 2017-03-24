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


/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SettingsController extends BaseSettingsController
{
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
        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->engineer;
        $practice = $model->practice;
        $query_pe = $practice ? \common\models\PracticeEngineers::find()->where(['practice_id' => $practice->engineer_id]) : null;

        return $this->render('practice-setup', [
            'model' => $model,
            'practice' => $practice,
            'practiceEngineers' => new ActiveDataProvider([
                'query' => $query_pe,
            ])
        ]);
    }

    /**
     * C114
     * @return mixed
     */
    public function actionPortfolioSetup()
    {
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
        /** @var SettingsForm $model */
        $settings = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($settings);

        $model = $settings->user->client;

        return $this->render('document-client', [
            'model' => $model,
        ]);
    }
}
