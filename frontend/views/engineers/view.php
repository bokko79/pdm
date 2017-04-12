<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjeri'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['profile'] = $model;
     
$items = [
    [
        'label'=>'<i class="fa fa-shield"></i> Profil',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],    
    [
        'label'=>'<i class="fa fa-file-powerpoint-o"></i> Projekti',
        'content'=>$this->render('tabs/_projects', ['model'=>$model, 'projects'=>$projects]),
    ],
    [
        'label'=>'<i class="fa fa-user-circle-o"></i> Portfolio',
        'content'=>$this->render('tabs/_portfolio', ['model'=>$model]),
    ],
    [
        'label'=>'<i class="fa fa-file-text"></i> Dokumenti',
        'content'=>$this->render('tabs/_docs', ['model'=>$model, 'engineerFiles'=>$engineerFiles]),
    ],
     [
        'label'=>'<i class="fa fa-tags"></i> Licence',
        'content'=>$this->render('tabs/_licences', ['model'=>$model, 'engineerLicences' => $engineerLicences]),
    ],
];
?>
<div class="row">
    <div class="col-md-3" style="z-index:1">
        <?= $this->render('_menu', ['model'=>$model, 'projects'=>$projects]) ?>
    </div>
    <div class="col-md-9">
        <div class="card_container record-full grid-item fadeInUp no-shadow animated-not " id="">
          <div class="secondary-context">
            <div class="head major">
              <div class="subhead uppercase hint" style="margin-bottom: 5px;">Opis</div>                               
            </div>  
            <?= $model->about ?>             
          </div>
        </div> 
        <?= $this->render('tabs/_projects', ['model'=>$model, 'projects'=>$projects]) ?>
        <?php /* (Yii::$app->user->client!=null) ? $this->render('tabs/_requests', ['model'=>$model->client, 'requests'=>$requests]) : null */ ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="min-height:300px;">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                ]);
            ?>
        </div>  
    </div>
</div>