<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$menuItems = [
        //['label' => '<small>Treba Vam Arhitekta? Pošaljite upit</small>', 'url' => ['/requests/create'], 'visible'=>(\Yii::$app->user->can('client') or Yii::$app->user->isGuest), 'options'=>['style'=>'background:#eee;']],
        //['label' => '<i class="fa fa-file"></i> PDM', 'url' => ['/projects'], /*'visible'=>!Yii::$app->user->isGuest*//*],
        (Yii::$app->user->isGuest) ?
            ['label' => '<img src="/images/avatar-blank.jpg" class="user-img" alt="" data-pin-nopin="true"><span class="hidden-md hidden-sm hidden-xs"> Login</span>', 'url' => \Yii::$app->user->loginUrl] :
       
            ['label' => Yii::$app->user->avatar. ' <span class="hidden-md hidden-sm hidden-xs">' .Yii::$app->user->identity->username.'</span>', 'items'=>[
                ['label' => '<i class="fa fa-user"></i> '.Yii::$app->user->identity->username. ': početna', 'url' => ['/home'], 'options'=>[]],
                '<hr>',
                ['label' => '<i class="fa fa-cogs"></i> Podešavanje naloga', 'url' => ['/user/settings/account'], 'options'=>[]],
                '<hr>',
                ['label' => Yii::t('user', 'Inženjer'), 'url' => ['/engineers/update', 'id'=>Yii::$app->user->identity->id], 'visible' => Yii::$app->user->engineer!=null],                                     
                '<hr>',
                ['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                
                '<hr>',
                ['label' => '<i class="fa fa-bullhorn"></i> Pozovi kolegu', 'url' => ['/site/invite'], 'options'=>[]],
                '<hr>',
                ['label' => '<i class="fa fa-sign-out"></i> Odjava', 'url' => ['/site/logout'], 'options'=>[], 'linkOptions'=>['data'=>['method'=>'post']]],

            ], 'options'=>['style'=>''], 'linkOptions'=>['style'=>'']],
        
            
            
        //['label' => 'Help', 'url' => ['/site/contact']],
        //['label' => '<i class="fa fa-bullhorn"></i> Zahtevi', 'url' => ['/requests']],
        //['label' => '<i class="fa fa-article"></i> Blog', 'url' => ['/posts']],
        //['label' => '<i class="fa fa-article"></i> Profili', 'url' => ['/site/profiles']],
        
        //['label' => '<i class="fa fa-file-o"></i> Projekti', 'url' => ['/projects']],
        //['label' => '<i class="fa fa-shield"></i> Projektanti', 'url' => ['/practices']],

        //['label' => '<i class="fa fa-user-circle-o"></i> Inženjeri', 'url' => ['/engineers']],
        /*['label' => '<i class="fa fa-building"></i> Investitori', 'url' => ['/clients']],
        '<hr>',
        ['label' => '<i class="fa fa-file"></i> Dokumenti projekata', 'url' => ['/project-files']],
        ['label' => '<i class="fa fa-file-o"></i> Ostali dokumenti', 'url' => ['/legal-files']], */
          
    ];

?>
   <div id="top-nav" class="top-nav">
        <!-- BEGIN container -->
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="fs_11"><a href="#"><i class="fa fa-phone"></i> +381 (0) 64 135 95 30</a></li>
                    <li class="fs_11"><a href="#"><i class="fa fa-at"></i> masterplan.arc@gmail.com</a></li>       
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/posts">Info</a></li>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="https://www.facebook.com/masterplan/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" target="_blank"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" target="_blank"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" target="_blank"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- END container -->
    </div>

    <div id="header" class="header" data-fixed-top="true">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN header-container -->
            <div class="header-container">
                <!-- BEGIN navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="true">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="header-logo">
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <!--<span class="brand"></span>-->
                            <?= Html::img('/images/logo2-small.png', ['style'=>'width:150px;']) ?>
                            <small style="font-size:55%;"><span>Arhitektonski projekti i nekretnine</span></small>
                        </a>
                    </div>
                </div>
                <!-- END navbar-header -->

                
                <!-- BEGIN header-nav -->
                <div class="header-nav">
                    <div class="navbar-collapse collapse" id="navbar-collapse">
                        <ul class="nav">
                            <li><a href="/projects">Projekti</a></li>
                            <li><a href="/practices">Projektanti</a></li>
                            
                        </ul>
                    </div>
                </div>
                <!-- END header-nav -->
                
                <!-- BEGIN header-nav -->
                <div class="header-nav">
                    <?php  echo Nav::widget([
                        'options' => ['class' => 'nav pull-right'],
                        'items' => $menuItems,
                        'encodeLabels' => false,
                    ]); ?>
                </div>
                <!-- END header-nav -->
            </div>
            <!-- END header-container -->
        </div>
        <!-- END container -->
    </div>
    <?php /*
    NavBar::begin([
        'brandLabel' => Html::img('/images/logo2-small.png', ['style'=>'width:150px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
            //'data-spy' => 'affix',
            //'data-offset-top' => 150,
        ],
    ]);

    $menuItems = [
        //['label' => '<small>Treba Vam Arhitekta? Pošaljite upit</small>', 'url' => ['/requests/create'], 'visible'=>(\Yii::$app->user->can('client') or Yii::$app->user->isGuest), 'options'=>['style'=>'background:#eee;']],
        //['label' => '<i class="fa fa-file"></i> PDM', 'url' => ['/projects'], /*'visible'=>!Yii::$app->user->isGuest*//*],
        (Yii::$app->user->isGuest) ?
            ['label' => 'Login', 'url' => \Yii::$app->user->loginUrl] :
       
            ['label' => ((Yii::$app->user->engineer and Yii::$app->user->engineer->aFile) ? Html::img('/images/profiles/'.Yii::$app->user->engineer->aFile->name, ['style'=>'width:30px; height:30px;border-radius:3px;']) : Html::img('/images/no_pic_image.png', ['style'=>'width:30px; height:30px;border-radius:3px;'])). ' ' .Yii::$app->user->identity->username, 'items'=>[
                ['label' => '<i class="fa fa-user"></i> '.Yii::$app->user->identity->username. ': početna', 'url' => ['/home'], 'options'=>[]],
                '<hr>',
                ['label' => '<i class="fa fa-cogs"></i> Podešavanje naloga', 'url' => ['/user/settings/account'], 'options'=>[]],
                '<hr>',
                ['label' => Yii::t('user', 'Moji podaci (inženjer)'), 'url' => ['/engineers/update', 'id'=>Yii::$app->user->identity->id], 'visible' => Yii::$app->user->engineer!=null],                                     
                ['label' => Yii::t('user', 'Podešavanje licenci'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                ['label' => Yii::t('user', 'Moj portfolio'), 'url' => ['/user/settings/portfolio-setup'], 'visible' => Yii::$app->user->engineer!=null],
                '<hr>',
                ['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                ['label' => Yii::t('user', 'Investitori firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab2'], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                ['label' => Yii::t('user', 'Inženjeri firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab1'], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                ['label' => Yii::t('user', 'Partneri firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab1'], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                ['label' => Yii::t('user', 'Podešavanje firme'), 'url' => ['/practices/update', 'id'=>Yii::$app->user->identity->id], 'visible' => Yii::$app->user->engineer!=null and Yii::$app->user->engineer->practice!=null],
                '<hr>',
                ['label' => '<i class="fa fa-bullhorn"></i> Pozovi kolegu', 'url' => ['/site/invite'], 'options'=>[]],
                '<hr>',
                ['label' => '<i class="fa fa-sign-out"></i> Odjava', 'url' => ['/site/logout'], 'options'=>[], 'linkOptions'=>['data'=>['method'=>'post']]],

            ], 'options'=>['style'=>'background:#eee; padding:0;'], 'linkOptions'=>['style'=>'padding:15px;']],
        
            
            
        //['label' => 'Help', 'url' => ['/site/contact']],
        //['label' => '<i class="fa fa-bullhorn"></i> Zahtevi', 'url' => ['/requests']],
        //['label' => '<i class="fa fa-article"></i> Blog', 'url' => ['/posts']],
        //['label' => '<i class="fa fa-article"></i> Profili', 'url' => ['/site/profiles']],
        ['label' => '<i class="fa fa-file-o"></i> Projekti', 'url' => ['/projects']],
        ['label' => '<i class="fa fa-shield"></i> Projektanti', 'url' => ['/practices']],
        //['label' => '<i class="fa fa-user-circle-o"></i> Inženjeri', 'url' => ['/engineers']],
        /*['label' => '<i class="fa fa-building"></i> Investitori', 'url' => ['/clients']],
        '<hr>',
        ['label' => '<i class="fa fa-file"></i> Dokumenti projekata', 'url' => ['/project-files']],
        ['label' => '<i class="fa fa-file-o"></i> Ostali dokumenti', 'url' => ['/legal-files']],
          
    ]; /*
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    
    NavBar::end(); */
    ?>

    