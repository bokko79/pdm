<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Podešavanja'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['model'] = $model;

$items = [
    [
        'label'=>'<i class="fa fa-shield"></i> Nalog',
        'content'=>$this->render('tabs/_account', ['model'=>$engineer]),
        'active'=>true
    ],
    [
        'label'=>'<i class="fa fa-user-circle-o"></i> Inženjer',
        'content'=>$this->render('tabs/_portfolio', ['model'=>$engineer]),
    ],
    [
        'label'=>'<i class="fa fa-user-circle-o"></i> Portfolio',
        'content'=>$this->render('tabs/_portfolio', ['model'=>$engineer]),
    ],
    [
        'label'=>'<i class="fa fa-file-text"></i> Dokumenti',
        'content'=>$this->render('tabs/_docs', ['model'=>$engineer, 'engineerFiles'=>$engineerFiles]),
    ],
    [
        'label'=>'<i class="fa fa-tags"></i> Licence',
        'content'=>$this->render('tabs/_licences', ['model'=>$engineer, 'engineerLicences' => $engineerLicences]),
    ],
];
?>

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