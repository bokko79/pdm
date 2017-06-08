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
            ['label' => '<img src="images/avatar-blank.jpg" class="user-img" alt="" data-pin-nopin="true"><span class="hidden-md hidden-sm hidden-xs"> Login</span>', 'url' => \Yii::$app->user->loginUrl] :
       
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
        

          
    ];

?>


    <div id="" class="header dashboard" data-fixed-top="true">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN header-container -->
            <div class="header-container">
                <!-- BEGIN navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle navbar-toggle-sidebar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="header-logo">
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <!--<span class="brand"></span>-->
                            <?= Html::img('/images/logo3-white.png', ['style'=>'width:150px;']) ?>
                            <small style="font-size:55%;"><span>Arhitektonski projekti i nekretnine</span></small>
                        </a>
                    </div>
                </div>
                <!-- END navbar-header -->

                
                <!-- BEGIN header-nav -->
                <div class="header-nav">
                    <button type="button" class="navbar-toggle navbar-toggle-fa" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="true">
                        <i class="fa fa-caret-down white "></i>
                    </button>
                    <div class="navbar-collapse collapse" id="navbar-collapse">
                        <ul class="nav pull-right">
                            <li><a href="/projects">Projekti</a></li>
                            <li><a href="/practices">Projektanti</a></li>                           
                        </ul>
                    </div>
                </div>
                <!-- END header-nav -->
         <?php /*       
                <!-- BEGIN header-nav -->
                <div class="header-nav">
                    <?php  echo Nav::widget([
                        'options' => ['class' => 'nav pull-right'],
                        'items' => $menuItems,
                        'encodeLabels' => false,
                    ]); ?>
                </div> */ ?>
                <!-- END header-nav -->
            </div>
            <!-- END header-container -->
        </div>
        <!-- END container -->
    </div>