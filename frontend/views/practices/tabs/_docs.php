
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Memorandum zaglavlje
            <div class="action-area normal-case"><?= ($model->memo) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->memoID->id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj memorandum zaglavlje', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'memo-header']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?= ($model->memo) ? Html::img('/images/legal_files/visual/'.$model->memo)  : null ?>
    </div>
</div>

<div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Logo
            <div class="action-area normal-case">
                <?= ($model->logo) ? Html::a('<i class="fa fa-cogs"></i>', Url::to(['/legal-files/update', 'id'=>$model->logoID->id]), ['class' => 'btn btn-success btn-sm']) : null ?>
                 <?php if(!$model->logo): ?><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'logo']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
            </div>
        </div>
       
    </div>
    <div class="secondary-context ">
        <?= ($model->logo) ? Html::img('/images/legal_files/visual/'.$model->logo, ['style'=>'max-height:180px;']) : null ?>
    </div>
</div>

<div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Pečat
            <div class="action-area normal-case"><?= ($model->stamp) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>
    </div>
    <div class="secondary-context ">
        <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp, ['style'=>'max-height:180px;']) : null ?>
    </div>
</div> 
                    
<div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Potpis ovl. lica
            <div class="action-area normal-case"><?= ($model->signature) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-success btn-sm']) :  Html::a('<i class="fa fa-plus-circle"></i> Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>
    </div>
    <div class="secondary-context">
        <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature, ['style'=>'max-height:180px;']) : null ?>
    </div>
</div> 

<div class="card_container record-full grid-item fadeInUp animated">
    <div class="primary-context gray normal">
        <div class="head">Rešenje APR
            <div class="action-area normal-case">
        <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr], ['class' => 'btn btn-link btn-sm']) : null ?>
        <?= ($model->apr) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-success btn-sm']) : null ?>
        <?php if(!$model->apr): ?><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>