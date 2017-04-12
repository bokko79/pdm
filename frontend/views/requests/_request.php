<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';

?>

<div class="card_container record-full transparent top-bordered no-shadow  fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden">
        
        <div class="title">
            <div class="subhead">
                <i class="fa fa-clock-o"></i> <?= $formatter->asDate($model->time, 'php:n. mm Y. H:i') ?>
            </div>
            <div class="head regular">
                <?= Html::a(c($model->fullname), Url::to(['/requests/view?id='.$model->id]), []) ?>
                <span class="fs_11 muted">[@<?= $model->client->user->username ?>]</span> 
                <?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> aktivan</div>' : null ?>
            </div>
            <div class="subhead">
                <?= HtmlPurifier::process($model->location->fullAddress) ?>
            </div>
        </div>
        <div class="subaction">
            <?= Html::a('<i class="fa fa-arrow-circle-right"></i>&nbsp;'.Yii::t('app', 'Pregled'), Url::to(['/requests/view?id='.$model->id]), ['class'=>'btn btn-default btn-sm shadow', 'style'=>'']) ?>            
        </div>          
    </div>
</div>