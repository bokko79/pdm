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
        'brandUrl' => (\Yii::$app->controller->action->id=='register' or \Yii::$app->controller->action->id=='login' or \Yii::$app->controller->action->id=='register-client') ? Yii::$app->homeUrl : null,
        'options' => [
            'class' => 'navbar-transparent navbar-top',
        ],
    ]);
    
    if(\Yii::$app->controller->action->id=='register' or \Yii::$app->controller->action->id=='login' or \Yii::$app->controller->action->id=='register-client'):
    $menuItems = [
        ['label' => 'Login', 'url' => ['/user/security/login']],
        //['label' => 'Standardna registracija', 'url' => ['/user/registration/register-client']],
        ['label' => 'Registracija inženjera', 'url' => ['/user/registration/register']],
          
    ];
    else:
       $menuItems = []; 
    endif;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    
    ?>