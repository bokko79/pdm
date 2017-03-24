<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-full transparent top-bordered no-shadow  fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden low-margin">
        <div class="avatar round">
            <?= ($model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'max-height:180px;']) : null ?>
        </div>
        <div class="title">
            <div class="head lower regular" style="line-height: 22px;">
                <?= Html::a(c($model->name), Url::to(['/practices/view?id='.$model->engineer_id]), []) ?>
                <span class="fs_11 muted">[<?= c($model->name) ?>]</span> 
                <?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> aktivan</div>' : null ?>
            </div>
            <div class="subhead">
                <?= HtmlPurifier::process($model->location->fullAddress) ?>
            </div>
        </div>
        <div class="subaction">
            <?= Html::a('<i class="fa fa-arrow-circle-right"></i>&nbsp;'.Yii::t('app', 'Pregled'), Url::to(['/practices/view?id='.$model->engineer_id]), ['class'=>'btn btn-default btn-sm shadow', 'style'=>'']) ?>            
        </div>          
    </div>
</div>