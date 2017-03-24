<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
            <div class="primary-context normal">
                <div class="head">Potpis ovlašćenog lica
                <div class="action-area normal-case"><?= (!$model->signature) ?  Html::a('Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->user_id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-primary btn-sm shadow']) : Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-success btn-sm shadow']) ?></div>
               </div>
            </div>
            <div class="secondary-context">
                <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature, ['style'=>'max-height:360px;']) : null ?>
            </div>
        </div>