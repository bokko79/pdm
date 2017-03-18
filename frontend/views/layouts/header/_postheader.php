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
</div>