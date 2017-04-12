<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$user = $model->user;
?>

<div class="card_container record-full transparent top-bordered no-shadow  fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden low-margin">
        <div class="avatar round">
            <?php // ($user->engineer!=null) ? Html::img('/images/profiles/'.$model->user->engineer->aFile->name, ['style'=>'max-height:180px;']) : null //  ?>
        </div>
        <div class="title">
            <div class="head lower regular" style="line-height: 22px;">
                @<?= $model->user->username ?>
                <span class="fs_11 muted">[<?= $formatter->asDate($model->time, 'php:n mm Y, H:i') ?>]</span> 
                <?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> '.$model->request->status.'</div>' : null ?>
            </div>
            <div class="subhead">
                <?= HtmlPurifier::process($model->body) ?>
            </div>
        </div>          
    </div>
</div>