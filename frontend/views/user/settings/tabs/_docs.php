<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<div class="card_container record-full grid-item fadeInUp animatedn" id="">
    <div class="primary-context gray normal">
        <div class="head  third">Memorandum zaglavlje
            <div class="subaction"><?= ($model->memorandum) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/practices/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj memorandum zaglavlje', Url::to(['/practices/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?= ($model->memorandum) ? Html::img('/images/legal_files/visual/'.$model->memorandum->name)  : null ?>
    </div>
</div>

<div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head  third">Logo
            <div class="subaction">
                <?= ($model->logo) ? Html::a('<i class="fa fa-cogs"></i>', Url::to(['/practices/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-success btn-sm']) : null ?>
                 <?php if(!$model->logo): ?><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'logo']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
            </div>
        </div>
       
    </div>
    <div class="secondary-context ">
        <?= $model->logo ?>
    </div>
</div>

<div class="card_container record-full grid-item fadeInUp animatedn" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head  third">Pečat
            <div class="subaction"><?php /* ($model->stamp) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-primary btn-sm']) */ ?></div>
        </div>
    </div>
    <div class="secondary-context ">
        <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->sFile->name, ['style'=>'max-height:180px;']) : null ?>
    </div>
</div> 
                    
<div class="card_container record-full grid-item fadeInUp animatedn" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head  third">Potpis ovl. lica
            <div class="subaction"><?= Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/engineers/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
    </div>
    <div class="secondary-context">
        <?= $model->director->engSignature ?>
    </div>
</div> 

<div class="card_container record-full grid-item fadeInUp animatedn">
    <div class="primary-context gray normal">
        <div class="head third">Rešenje APR
            <div class="action-area normal-case">
        <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr], ['class' => 'btn btn-link btn-sm']) : null ?>
        <?= ($model->apr) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-success btn-sm']) : null ?>
        <?php if(!$model->apr): ?><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>