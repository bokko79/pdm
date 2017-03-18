
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
                $client = $projectClient->client;
                echo Html::a('<i class="fa fa-building"></i> '.$client->name . '<br>'.$client->location->fullAddress, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => 'btn btn-default btn-sm shadow']).'<hr>';
            }
        } ?>
    </div>                
</div>