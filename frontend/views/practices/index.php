<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PracticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Firme');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
        <h5><i class="fa fa-filter"></i> Filter</h5><br>
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-sm-6">

        <?php
                
            echo Nav::widget([
                'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000; margin: 0 0 0 0'],
                'encodeLabels' => false,
                'items' => [                                
                    ['label' => '<i class="fa fa-building"></i> Firme', 'url' => ['/practices/index'], 'linkOptions'=>['style'=>'']],
                    
                    // investitori projekta
                    ['label' => '<i class="fa fa-users"></i> Inženjeri', 'url' => ['/engineers/index']],

                ]
            ]);
         ?>
         <hr>
         <?= $this->render('_searchByName', ['model' => $searchModel]); ?>
  
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_practice',
            'itemOptions' => [],
        ]) ?>
    </div>
    <div class="col-sm-3">
        <?php if(Yii::$app->user->isGuest or !Yii::$app->user->engineer): ?>
            <?= $this->render('../engineers/_registerAs'); ?>
            <hr>
        <?php endif; ?>
        <div class="card_container record-full grid-item transparent fadeInUp no-shadow animated-not no-margin" id="" style="float:none;">
            <div class="primary-context no-padding">
                <div class="head lower regular">
                    Top firme                   
                </div>              
            </div> 
        </div>
        <?php echo ListView::widget([
              'dataProvider' => $dataProvider,
              'itemView' => '_practice_short',
              'layout' => '{items}',
          ]); ?>
    </div>
 </div>
</div>
