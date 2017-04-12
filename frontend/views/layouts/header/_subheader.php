<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>
  

    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/images/logo2-small.png', ['style'=>'width:150px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    
    $menuItems = [
        //['label' => '<small>Treba Vam Arhitekta? Pošaljite upit</small>', 'url' => ['/requests/create'], 'visible'=>(\Yii::$app->user->can('client') or Yii::$app->user->isGuest), 'options'=>['style'=>'background:#eee;']],
        //['label' => '<i class="fa fa-file"></i> PDM', 'url' => ['/projects'], /*'visible'=>!Yii::$app->user->isGuest*/],
        (Yii::$app->user->isGuest) ? 
            ['label' => 'Login', 'url' => \Yii::$app->user->loginUrl] : 
            ['label' => '<i class="fa fa-user"></i> '.Yii::$app->user->identity->username, 'url' => ['//user/security/home', 'username'=>Yii::$app->user->identity->username], 'options'=>['style'=>'background:#eee']],
        //['label' => 'Help', 'url' => ['/site/contact']],
        //['label' => '<i class="fa fa-bullhorn"></i> Zahtevi', 'url' => ['/requests']],
        //['label' => '<i class="fa fa-article"></i> Blog', 'url' => ['/posts']],
        //['label' => '<i class="fa fa-article"></i> Profili', 'url' => ['/site/profiles']],
        ['label' => '<i class="fa fa-file-o"></i> Projekti', 'url' => ['/projects']],
        ['label' => '<i class="fa fa-shield"></i> Firme', 'url' => ['/practices']],
        ['label' => '<i class="fa fa-user-circle-o"></i> Inženjeri', 'url' => ['/engineers']],
        /*['label' => '<i class="fa fa-building"></i> Investitori', 'url' => ['/clients']],
        '<hr>',
        ['label' => '<i class="fa fa-file"></i> Dokumenti projekata', 'url' => ['/project-files']],
        ['label' => '<i class="fa fa-file-o"></i> Ostali dokumenti', 'url' => ['/legal-files']],*/
          
    ];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>