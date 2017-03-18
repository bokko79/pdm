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
        ['label' => '<i class="fa fa-question"></i> Pošalji upit', 'url' => ['/posts']],
        ['label' => '<i class="fa fa-file"></i> PDM', 'url' => ['/projects'], /*'visible'=>!Yii::$app->user->isGuest*/],
        
        //['label' => 'Help', 'url' => ['/site/contact']],
        ['label' => '<i class="fa fa-article"></i> Blog', 'url' => ['/posts']],
        ['label' => '<i class="fa fa-article"></i> Profili', 'url' => ['/profiles']],
        ['label' => '<i class="fa fa-database"></i> Baza podataka', 'visible'=>!Yii::$app->user->isGuest,
            'items' => [
                ['label' => '<i class="fa fa-shield"></i> Firme', 'url' => ['/practices']],
                ['label' => '<i class="fa fa-user-circle-o"></i> Inženjeri', 'url' => ['/engineers']],
                ['label' => '<i class="fa fa-building"></i> Investitori', 'url' => ['/clients']],
                '<hr>',
                ['label' => '<i class="fa fa-file"></i> Dokumenti projekata', 'url' => ['/project-files']],
                ['label' => '<i class="fa fa-file-o"></i> Ostali dokumenti', 'url' => ['/legal-files']],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Registracija', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Odjava (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>