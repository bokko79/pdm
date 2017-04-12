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
        <div class="head">
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj postojeći objekat', Url::to(['/project-lot-existing-buildings/create', 'ProjectLotExistingBuildings[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
            Postojeći objekti na parceli
        </div>
        <div class="subhead">Lista postojećih objekata na predmetnoj parceli.
        </div>
    </div>
    <div class="secondary-context">
        <?php if($existings = $model->project->projectLotExistingBuildings){
            foreach($existings as $existing){
                echo Html::a(c($existing->mark. ' - '.$existing->buildingType->name.' '.$existing->storeys), Url::to(['/project-lot-existing-buildings/update', 'id'=>$existing->id]), ['class' => 'btn btn-default', 'style'=>'']).'<br>';
            }
        } else {
            echo 'Nije unet nijedan postojeći objekat.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj postojeći objekat', Url::to(['/project-lot-existing-buildings/create', 'ProjectLotExistingBuildings[project_id]'=>$model->project_id]), ['class' => 'btn btn-link btn-sm']);
            } ?>
    </div>
</div>