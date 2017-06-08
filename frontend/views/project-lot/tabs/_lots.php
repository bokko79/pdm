<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="location-lots">
    <div class="primary-context gray normal">
        <div class="head">Katastarske parcele
        </div>      
        <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
    </div>
    <div class="primary-context gray normal">
        <div class="head major">
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-success btn-sm']) ?></div>
            Građevinske parcele
        </div>      
        <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
    </div>
    <div class="secondary-context">                   
        <?php if($lots = $model->project->location->locationLots){
            foreach($lots as $lot){
                echo Html::a($lot->fullAddress, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } else {
            echo 'Nije uneta nijedna katastarska parcela.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-link btn-sm']);
            } ?>
    </div>
    <div class="primary-context gray normal">
        <div class="head major">
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-success btn-sm']) ?></div>
            Parcele instalacija
        </div>    
        <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>                     
    </div>
    <div class="secondary-context">
        <?php if($lots = $model->project->location->serviceLots){
            foreach($lots as $lot){
                echo Html::a($lot->fullAddress, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } else {
            echo 'Nije uneta nijedna parcela instalacija.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-link btn-sm']);
            } ?>
    </div>
    <div class="primary-context gray normal">
        <div class="head major">
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-success btn-sm']) ?></div>
            Parcele pristupa
        </div>                    
        <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>   
    </div>
    <div class="secondary-context ">
        <?php if($lots = $model->project->location->accessLots){
            foreach($lots as $lot){
                echo Html::a($lot->fullAddress, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } else {
            echo 'Nije uneta nijedna parcela pristupa.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-link btn-sm']);
            } ?>
    </div>
    </div>