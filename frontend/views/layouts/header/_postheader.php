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


    <div class="navbar navbar-material-blog navbar-info navbar-overlay navbar-absolute-top" style="z-index: 1">

      <div class="navbar-image" style="background-image: url('/images/bg1.jpg'); background-position: center 30%; opacity: .45; display: block;"></div>

      <div class="navbar-wrapper container" style="padding-top: 180px;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle white" data-toggle="collapse" data-target=".navbar-responsive-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar white" style="background:white"></span>
                <span class="icon-bar white" style="background:white"></span>
                <span class="icon-bar white" style="background:white"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/logo3-white.png" alt="" style="width:180px;"></a>
        </div>        
        <div class="navbar-collapse collapse navbar-responsive-collapse">
        <?php                
                    echo Nav::widget([
                        'options'=>['class'=>'nav navbar-nav', 'style'=>'z-index:10000'],
                        'encodeLabels' => false,
                        'items' => [                                
                            
                            ['label' => '<i class="fa fa-bullhorn"></i> Vesti', 'url' =>['/posts/index', 'PostsSearch[type]'=>'news']],

                            ['label' => '<i class="fa fa-newspaper-o"></i> Članci', 'url' =>['/posts/index', 'PostsSearch[type]'=>'article']],

                            ['label' => '<i class="fa fa-graduation-cap"></i> Stručno', 'url' =>['/posts/index', 'PostsSearch[type]'=>'edu']],

                            ['label' => '<i class="fa fa-gavel"></i> Regulativa', 'url' =>['/posts/index', 'PostsSearch[type]'=>'info']],

                            ['label' => '<i class="fa fa-star"></i> Promo', 'url' =>['/posts/index', 'PostsSearch[type]'=>'promo']],

                            ['label' => '<i class="fa fa-life-ring"></i> Pomoć', 'url' =>['/posts/index', 'PostsSearch[type]'=>'help']],                           
                            
                        ]
                    ]);
                ?>
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <?php /*
<div class="header-wrapper hover" style="">
    

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class'=>'transparent breadcrumb']
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context normal">
                        <div class="head grand thin"><i class="fa fa-file-powerpoint-o"></i> <?= 'Info' ?>
                    
                        </div>
                        <div class="subhead">Podaci projekta.</div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <?php                
                    echo Nav::widget([
                        'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000'],
                        'encodeLabels' => false,
                        'items' => [                                
                            
                            ['label' => '<i class="fa fa-bullhorn"></i> Vesti', 'url' =>['/posts/index', 'PostsSearch[type]'=>'news']],

                            ['label' => '<i class="fa fa-newspaper-o"></i> Članci', 'url' =>['/posts/index', 'PostsSearch[type]'=>'article']],

                            ['label' => '<i class="fa fa-graduation-cap"></i> Stručno', 'url' =>['/posts/index', 'PostsSearch[type]'=>'edu']],

                            ['label' => '<i class="fa fa-gavel"></i> Regulativa', 'url' =>['/posts/index', 'PostsSearch[type]'=>'info']],

                            ['label' => '<i class="fa fa-star"></i> Promo', 'url' =>['/posts/index', 'PostsSearch[type]'=>'promo']],

                            ['label' => '<i class="fa fa-life-ring"></i> Pomoć', 'url' =>['/posts/index', 'PostsSearch[type]'=>'help']],                           
                            
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div>
</div> */?>