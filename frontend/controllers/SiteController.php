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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInvite()
    {
        $model = new \common\models\Invite();
        if ($model->load(Yii::$app->request->post()) && $model->invite()) {
            return $this->goBack();
        } else {
            return $this->render('invite', [
                'model' => $model,
            ]);
        }
        
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

    public function actionTest($id, $volume=null)
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        
        return $this->render('test', [
            'model' => $model,
            'volume' => $volume,
        ]);
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

    public function actionGlavnaSveska($id, $volume)
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf();  
        $mpdf->tMargin = $volume->practice->memo ? 35 : 15;           
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $volume->code . ': 0 - Glavna sveska';  
        
        if($volume->practice->memo){
            $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$volume->practice->memo, ['style'=>'margin-bottom:20px;']));                   
        }

        $mpdf->WriteHTML($this->renderPartial('pdf/_header_gl', ['model'=>$model, 'volume'=>$volume], true), 0); 
        
        $mpdf->SetWatermarkText('PRIMERAK');

        $mpdf->showWatermarkText = true;
        // 0.1. Naslovna strana glavne sveske
        // Obavezno u svim slučajevima
        $mpdf->WriteHTML($this->renderPartial('insets/0_1_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();


        // 0.2. Sadržaj glavne sveske
        // Obavezno u svim slučajevima
        $mpdf->WriteHTML($this->renderPartial('insets/0_2_sadrzaj', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.3. Odluka o određivanju glavnog projektanta
        // Samo u IDP, PGD, PZI, PIO
        if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'){
            $mpdf->WriteHTML($this->renderPartial('insets/0_3_odluka', ['model'=>$model, 'volume'=>$volume], true), 0);
            $mpdf->AddPage();
        }
        // 0.4. Izjava glavnog projektanta
        // Samo u IDP, PGD, PZI, PIO
        if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'){
            $mpdf->WriteHTML($this->renderPartial('insets/0_4_izjava', ['model'=>$model, 'volume'=>$volume], true), 0);            
            $mpdf->AddPage();
        }       

        // 0.5. Sadržaj tehničke dokumentacije
        $mpdf->WriteHTML($this->renderPartial('insets/0_5_sadrzaj_tehdok', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.6. Podaci o projektantima
        $mpdf->WriteHTML($this->renderPartial('insets/0_6_podaci', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.7. Opšti podaci o objektu
        $mpdf->WriteHTML($this->renderPartial('insets/0_7_opsti', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.8. Sažeti tehnički opis 
        // Samo u IDP, PGD i PIO 
        if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pio'){          
            if($model->work=='adaptacija'){
                $mpdf->WriteHTML($this->renderPartial('insets/0_8_02_tehopis_adap', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();
            } else {
                if($model->work!='promena_namene'){
                    $mpdf->WriteHTML($this->renderPartial('insets/0_8_1_projektni', ['model'=>$model, 'volume'=>$volume], true), 0);            
                    $mpdf->AddPage();
                }                
                $mpdf->WriteHTML($this->renderPartial('insets/0_8_tehopis', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();
            }
        }
        
        // 0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat 
        // Samo u IDP i PGD 
        if($model->checkIfElaborat and ($model->phase=='idp' or $model->phase=='pgd')) {
            $mpdf->WriteHTML($this->renderPartial('insets/0_9_ovl_lica', ['model'=>$model, 'volume'=>$volume], true), 0);
           // $mpdf->AddPage();
        }

        // insert lokacijskiUslovi.
        if($model->lokacijskiUslovi->file){
            $mpdf->SetHeader('');
            $pagecount = $mpdf->SetSourceFile('images/projects/'.$model->year.'/'.$id.'/'.$model->lokacijskiUslovi->file->name);
            for ($i=1; $i<=$pagecount; $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }

        // 0.11. Izjava investitora, vršioca stručnog nadzora i izvođača radova
        // Samo u PIO
        if($model->phase=='pio') {
            $mpdf->WriteHTML($this->renderPartial('insets/0_11_investitor', ['model'=>$model, 'volume'=>$volume], true), 0);
        }

        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);

        $mpdf->Output($volume->code . ': 0 - Glavna sveska.pdf', 'I');
        exit;
    }

    public function actionProjekat($id, $volume=null)
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf();  
        $mpdf->tMargin = 35;
        $mpdf->lMargin = 100;            
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $volume->code . ': '.$volume->number.' - '.($volume->name ?: $volume->volume->name);       
      
        $mpdf->SetImportUse();        

        $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$volume->practice->memo, ['style'=>'margin-bottom:20px;']));
        $mpdf->WriteHTML($this->renderPartial('pdf/_header', ['model'=>$model, 'volume'=>$volume], true), 0);       
        // 1.1. Naslovna strana projekta
        // Obavezno u svim slučajevima
        $mpdf->SetWatermarkText('PRIMERAK');

        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML($this->renderPartial('insets/1_1_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();
        // 1.1.1 Potvrda tehničke kontrole da se projekat prihvata
        // SAMO U PGD
        if($model->phase=='pgd'){
            $mpdf->WriteHTML($this->renderPartial('insets/1_1_1_prihvatase', ['model'=>$model, 'volume'=>$volume], true), 0);
            $mpdf->AddPage();
        }
        // 1.2. Sadržaj projekta
        // Obavezno u svim slučajevima
        $mpdf->WriteHTML($this->renderPartial('insets/1_2_sadrzaj', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 1.3. Odluka o određivanju odgovornog projektanta
        // Samo u IDP, PGD, PZI, PIO
        if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'){
            $mpdf->WriteHTML($this->renderPartial('insets/1_3_resenje', ['model'=>$model, 'volume'=>$volume], true), 0);
            $mpdf->AddPage();
        }
        // 1.4. Izjava odgovornog projektanta
        // Samo u IDP, PGD, PZI, PIO
        if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'){
            $mpdf->WriteHTML($this->renderPartial('insets/1_4_izjava', ['model'=>$model, 'volume'=>$volume], true), 0);            
            $mpdf->AddPage();
        }        

        // 1.5. Tekstualna dokumentacija - naslovna
        $mpdf->WriteHTML($this->renderPartial('insets/1_5_tekstualna_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();
            if($volume->volume_id==2){
                // 1.5.1 Tehnički opis
                $mpdf->WriteHTML($this->renderPartial('insets/1_5_1_tehn_opis', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();
            }

        // 1.6. Numerička dokumentacija - naslovna
        $mpdf->WriteHTML($this->renderPartial('insets/1_6_numericka_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();
            if($volume->volume_id==2){
                // 1.6.1 Obračun površina
                $mpdf->SetHeader('');
                $mpdf->AddPageByArray(['orientation'=>'L', 'sheet-size'=>'A2']);
                $mpdf->WriteHTML($this->renderPartial('insets/1_6_1_povrsine', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$volume->practice->memo, ['style'=>'margin-bottom:20px;']));
                $mpdf->AddPageByArray(['orientation'=>'P', 'sheet-size'=>'A4']);
                $mpdf->WriteHTML($this->renderPartial('insets/1_6_1_povrsine_SRPS', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPageByArray(['orientation'=>'P', 'sheet-size'=>'A4']);

                // 1.6.2 Predviđena vrednost objekta
                $mpdf->WriteHTML($this->renderPartial('insets/1_6_2_pivo', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();

                // 1.6.3 Predmer i predračun radova
                $mpdf->WriteHTML($this->renderPartial('qs/quantities', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();

                // 1.6.4 Šeme stolarije i bravarije, samo u projektu arhitekture
                $mpdf->WriteHTML($this->renderPartial('insets/1_6_4_scheme', ['model'=>$model, 'volume'=>$volume], true), 0);
                $mpdf->AddPage();
            }

        // 1.7. Grafička dokumentacija - naslovna
        $mpdf->WriteHTML($this->renderPartial('insets/1_7_graficka_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);
        /*$mpdf->AddPage();*/
        // insert KT plan, kopiju plana, geodetski snimak.
        if($model->geodetski){
            $mpdf->SetHeader('');
            $pagecount = $mpdf->SetSourceFile('images/projects/'.$model->year.'/'.$id.'/'.$model->geodetski->file->name);
            for ($i=1; $i<=$pagecount; $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }
        if($model->kopijaPlana){
            $mpdf->SetHeader('');
            $pagecount = $mpdf->SetSourceFile('images/projects/'.$model->year.'/'.$id.'/'.$model->kopijaPlana->file->name);
            for ($i=1; $i<=$pagecount; $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }
        if($model->kATPlan){
            $mpdf->SetHeader('');
            $pagecount = $mpdf->SetSourceFile('images/projects/'.$model->year.'/'.$id.'/'.$model->kATPlan->file->name);
            for ($i=1; $i<=$pagecount; $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }
        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);
        
        $mpdf->Output($volume->code . ': '.$volume->number.' - '.($volume->name ?: $volume->volume->name).'.pdf', 'I');
        exit;
    }

    public function actionIzvod($id, $volume)
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf();  
        $mpdf->tMargin = 35;           
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->defaultheaderline = 0; 
        $mpdf->title = $volume->code . ': Izvod iz projekta';  
        

        $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$volume->practice->memo, ['style'=>'margin-bottom:20px;']));
        $mpdf->WriteHTML($this->renderPartial('pdf/_header_gl', ['model'=>$model, 'volume'=>$volume], true), 0);   
        
        $mpdf->SetWatermarkText('PRIMERAK');

        $mpdf->showWatermarkText = true;

        $mpdf->WriteHTML($this->renderPartial('insets/izv_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();

        $mpdf->WriteHTML($this->renderPartial('insets/tk_izjava', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();

        $mpdf->WriteHTML($this->renderPartial('insets/tk_vrsioci', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();

        foreach($model->projectVolumes as $vol){
            if($vol->volume->type=='projekat'){
                $mpdf->WriteHTML($this->renderPartial('insets/tk_rezime', ['model'=>$model, 'vol'=>$vol], true), 0);        
                $mpdf->AddPage();
            }
        }

        // 0.1. Naslovna strana glavne sveske
        // Obavezno u svim slučajevima
        $mpdf->WriteHTML($this->renderPartial('insets/0_1_naslovna', ['model'=>$model, 'volume'=>$volume], true), 0);        
        $mpdf->AddPage();

        // 0.2. Sadržaj glavne sveske
        // Obavezno u svim slučajevima
        $mpdf->WriteHTML($this->renderPartial('insets/0_2_sadrzaj', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.3. Odluka o određivanju glavnog projektanta
        // Samo u IDP, PGD, PZI, PIO        
        $mpdf->WriteHTML($this->renderPartial('insets/0_3_odluka', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();
        
        // 0.4. Izjava glavnog projektanta
        // Samo u IDP, PGD, PZI, PIO        
        $mpdf->WriteHTML($this->renderPartial('insets/0_4_izjava', ['model'=>$model, 'volume'=>$volume], true), 0);            
        $mpdf->AddPage();
               

        // 0.5. Sadržaj tehničke dokumentacije
        $mpdf->WriteHTML($this->renderPartial('insets/0_5_sadrzaj_tehdok', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.6. Podaci o projektantima
        $mpdf->WriteHTML($this->renderPartial('insets/0_6_podaci', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.7. Opšti podaci o objektu
        $mpdf->WriteHTML($this->renderPartial('insets/0_7_opsti', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->AddPage();

        // 0.8. Sažeti tehnički opis 
        // Samo u IDP, PGD i PIO 
        $mpdf->WriteHTML($this->renderPartial('insets/0_8_1_projektni', ['model'=>$model, 'volume'=>$volume], true), 0);            
        $mpdf->AddPage();
        $mpdf->WriteHTML($this->renderPartial('insets/0_8_tehopis', ['model'=>$model, 'volume'=>$volume], true), 0);            
        $mpdf->AddPage();
        
        // 0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat 
        // Samo u IDP i PGD 
        if($model->checkIfElaborat) {
            $mpdf->WriteHTML($this->renderPartial('insets/0_9_ovl_lica', ['model'=>$model, 'volume'=>$volume], true), 0);
            //$mpdf->AddPage();
        }

        // insert lokacijskiUslovi.
        if($model->lokacijskiUslovi){
            $mpdf->SetHeader('');
            $pagecount = $mpdf->SetSourceFile('images/projects/'.$model->year.'/'.$id.'/'.$model->geodetski->file->name);
            for ($i=1; $i<=$pagecount; $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }

        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);

        $mpdf->Output($volume->code . ': Izvod iz projekta.pdf', 'I');
        exit;
    }

    public function actionOzakonjenje($id, $volume=null)
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

        $mpdf->Output($model->code . ': 0 - Glavna sveska.pdf', 'I');
        exit;
    }

    public function actionPovrsine($id, $volume=null, $format='B0', $orientation='P')
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf('utf-8', $format.'-'.$orientation);          
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->title = $model->code . ': Obračun redukovanih neto površina objekta';  

        $mpdf->WriteHTML($this->renderPartial('pdf/_header', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('insets/povrsine_tablice', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);
      
        $mpdf->Output($model->code . ' - Tablice površina.pdf', 'I');
        exit;
    }

    public function actionTablice($id, $volume=null, $format='A5', $orientation='L')
    {
        $model = \common\models\Projects::findOne($id);
        $volume = \common\models\ProjectVolumes::findOne($volume);
        $mpdf = new mpdf('utf-8', $format.'-'.$orientation);          
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        $mpdf->title = $volume->code . ': Tablice crteža';  

        $mpdf->WriteHTML($this->renderPartial('pdf/_header', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('insets/tablice_crtezi', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);
      
        $mpdf->Output($model->code . ' - Tablice površina.pdf', 'I');
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


    public function actionPredmer($id, $format='A4', $orientation='P')
    {
        $model = \common\models\Projects::findOne($id);
        $positions = $model->projectQs;
        $mpdf = new mpdf('utf-8', $format.'-'.$orientation);          
        //$mpdf->tMargin = 35;           
        $mpdf->backupSubsFont = array('arial', 'serif'); 
        //$mpdf->defaultheaderline = 0; 
        $mpdf->title = $model->code . ': Predmer i predračun radova';  

       // $mpdf->SetHeader(Html::img('@web/images/legal_files/visual/'.$model->practice->memo, ['style'=>'margin-bottom:20px;']));

        $mpdf->WriteHTML($this->renderPartial('pdf/_header', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('qs/quantities', ['model'=>$model, 'volume'=>$volume], true), 0);
        $mpdf->WriteHTML($this->renderPartial('pdf/_footer', ['model'=>$model, 'volume'=>$volume], true), 0);
      
        $mpdf->Output($model->code . ' - Tablice površina.pdf', 'I');
        exit;
    }
}
