<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use kartik\mpdf\Pdf;
use mPDF;
use yii\helpers\Html;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Hvala što ste nas kontaktirali. Odgovorićemo Vam u najkraćem mogućem roku.');
            } else {
                Yii::$app->session->setFlash('error', 'Pojavila se greška pri slanju poruke.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Provirite Vašu e-mail adresu za dalja uputstva.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Izvinite, nismo u mogućnosti da resetujemo lozinku za unetu e-mail adresu.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nova lozinka je sačuvana.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionDownload($path) 
    {
        $file = Yii::getAlias('@webroot') . $path;

        if (file_exists($file)){
            Yii::$app->response->sendFile($file);
        } 
    }

    public function actionReport($id) 
    {
        $model = \common\models\Projects::findOne($id);
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportView', ['model'=>$model], true);
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_ASIAN, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@frontend/web/css/style_pdf.css',
            // any css to be embedded if required
            //'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => '0 - Glavna sveska - '.$model->name],
             // call mPDF methods on the fly
            'methods' => [ 
                //'SetHeader'=>[\yii\helpers\Html::img('@web/images/legal_files/'.$model->practice->memo->file->name, [])], 

                //'SetFooter'=>['{PAGENO}'],
            ],
            'marginTop' => 10,
        ]);
     
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionGlavnaSveska($id, $volume=null)
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf();  
        $mpdf->tMargin = 35;
        $mpdf->lMargin = 100;            
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $model->code . ': 0 - Glavna sveska';  
        
        //$mpdf->AddPage($this->renderPartial('_reportView', ['model'=>$model], true), 0); 
        
        $mpdf->SetImportUse();
        /*$pagecount = $mpdf->SetSourceFile('images/legal_files/projektni.pdf');
        for ($i=1; $i<=$pagecount; $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }*/
        $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$model->practice->memo, ['style'=>'margin-bottom:20px;']));
        //$mpdf->AddPage();
        $mpdf->WriteHTML($this->renderPartial('volumes/_glavnaSveska', ['model'=>$model, 'volume'=>$volume], true), 0);
        //$mpdf->SetWatermarkText('eee');
        $mpdf->SetHeader();
        /*$pagecount1 = $mpdf->SetSourceFile('images/legal_files/docs/'.$model->practice->apr);
        for ($i=1; $i<=$pagecount1; $i++) {
            $mpdf->AddPage();
            $import_page1 = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page1);

        }*/
        $mpdf->Output($model->code . ': 0 - Glavna sveska.pdf', 'I');
        exit;
    }

    public function actionPovrsine($id, $volume=null, $format='A1', $orientation='L')
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf('utf-8', $format.'-'.$orientation);  
        //$mpdf->tMargin = 35;            
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $model->code . ': Obračun redukovanih neto površina objekta';  
        
        //$mpdf->AddPage($this->renderPartial('_reportView', ['model'=>$model], true), 0); 
        
        //$mpdf->SetImportUse();
        /*$pagecount = $mpdf->SetSourceFile('images/legal_files/projektni.pdf');
        for ($i=1; $i<=$pagecount; $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }*/
        //$mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$model->practice->memo, ['style'=>'margin-bottom:20px;']));
        //$mpdf->AddPage();
        $mpdf->WriteHTML($this->renderPartial('volumes/_glavnaSveska', ['model'=>$model, 'volume'=>$volume], true), 0);
        //$mpdf->SetWatermarkText('eee');
        //$mpdf->SetHeader();
        /*$pagecount1 = $mpdf->SetSourceFile('images/legal_files/docs/'.$model->practice->apr);
        for ($i=1; $i<=$pagecount1; $i++) {
            $mpdf->AddPage();
            $import_page1 = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page1);

        }*/
        $mpdf->Output($model->code . ' - Obračun površina.pdf', 'I');
        exit;
    }

    public function actionSeme($id, $volume=null, $format='A4', $orientation='P')
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf('utf-8', $format.'-'.$orientation);  
        $mpdf->tMargin = 58;            
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $model->code . ': Šeme stolarije i bravarije';  
        
        //$mpdf->AddPage($this->renderPartial('_reportView', ['model'=>$model], true), 0); 
        
        //$mpdf->SetImportUse();
        /*$pagecount = $mpdf->SetSourceFile('images/legal_files/projektni.pdf');
        for ($i=1; $i<=$pagecount; $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }*/
        //$mpdf->SetHeader();
        $mpdf->SetHeader($this->renderPartial('schemes/_header', ['model'=>$model, 'volume'=>$volume], true));
        //$mpdf->AddPage();
        $mpdf->WriteHTML($this->renderPartial('volumes/_arhitektura', ['model'=>$model, 'volume'=>$volume], true), 0);
        //$mpdf->SetWatermarkText('eee');
        //$mpdf->SetHeader();
        /*$pagecount1 = $mpdf->SetSourceFile('images/legal_files/docs/'.$model->practice->apr);
        for ($i=1; $i<=$pagecount1; $i++) {
            $mpdf->AddPage();
            $import_page1 = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page1);

        }*/
        $mpdf->Output($model->code . ' - Obračun površina.pdf', 'I');
        exit;
    }
}
