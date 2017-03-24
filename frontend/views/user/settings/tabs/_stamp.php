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
                <div class="head">Pečat preduzeća
                <div class="action-area normal-case"><?= (!$model->stamp) ? Html::a('Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->user_id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-success btn-sm shadow']) : Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-success btn-sm shadow'])  ?></div>
               </div>
            </div>
            <div class="secondary-context">
                <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp, ['style'=>'max-height:360px;']) : null ?>
            </div>
        </div>