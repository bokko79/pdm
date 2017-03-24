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
                <div class="head">Rešenje APR
                <div class="action-area normal-case"><?= (!$model->apr) ? Html::a('Dodaj rešenje APR', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->user_id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-primary btn-sm shadow']) : Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->user_id]), ['class' => 'btn btn-success btn-sm shadow']) ?></div>
               </div>
            </div>
            <div class="secondary-context">
                <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr]) : null ?>
            </div>
        </div>