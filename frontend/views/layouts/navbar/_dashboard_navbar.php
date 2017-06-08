<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;
?>


<div id="" class="header dashboard" data-fixed-top="true">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN header-container -->
        <div class="header-container">
            <!-- BEGIN navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-toggle-sidebar" >
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="true">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav pull-right">
                        <li><a href="/projects">Projekti</a></li>
                        <li><a href="/practices">Projektanti</a></li>
                        <li><a href="#">Nekretnine</a></li>
                        <li><a href="/posts">Članci</a></li>                        
                    </ul>
                </div>
            </div>
            <!-- END header-nav -->
            
            
        </div>
        <!-- END header-container -->
    </div>
    <!-- END container -->
</div>