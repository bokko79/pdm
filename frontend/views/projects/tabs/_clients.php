
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="client">
    <div class="primary-context gray normal">
        <div class="head">Investitori
        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi investitor', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm shadow']) ?>
            </div>
        </div>
        <div class="subhead">Lista investitora projekta.

        </div>
    </div>
    <div class="secondary-context">
        <?php if($projectClients = $model->projectClients){
            foreach($projectClients as $projectClient){
                $client = $projectClient->client; ?>

                <div class="header-context cont">
                    <div class="avatar">
                        <i class="fa fa-building fa-3x gray-color"></i>       
                    </div>
                    <div class="subaction">
                        <?= Html::a('<i class="fa fa-user-circle"></i>', ['/clients/view', 'id'=>$client->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
                    </div>
                    <div class="title" style="float:none; margin-left: 32px; ">
                        <div class="head lower"><?= Html::a($client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => '']) ?></div>
                        <div class="subhead"><?= $client->location->fullAddress ?></div>
                    </div>
                </div>
        <?php
            }
        } ?>
    </div>                
</div>