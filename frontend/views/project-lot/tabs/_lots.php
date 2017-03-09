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
        <div class="head">Katastarske parcele <i class="fa this-one fa-arrow-circle-right"></i>
        </div>      
        <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
    </div>
    <div class="primary-context gray normal">
        <div class="head">Građevinske parcele
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>      
        <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
    </div>
    <div class="secondary-context">                   
        <?php if($lots = $model->project->location->locationLots){
            foreach($lots as $lot){
                echo Html::a($lot->lot. ' K.O. '.$model->project->location->county0->name, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } ?>
    </div>
    <div class="primary-context gray normal">
        <div class="head">Parcele instalacija
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>    
        <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>                     
    </div>
    <div class="secondary-context">
        <?php if($lots = $model->project->location->serviceLots){
            foreach($lots as $lot){
                echo Html::a($lot->lot. ' K.O. '.$model->project->location->county0->name, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } ?>
    </div>
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Parcele pristupa
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>                    
        <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>   
    </div>
    <div class="secondary-context ">
        <?php if($lots = $model->project->location->accessLots){
            foreach($lots as $lot){
                echo Html::a($lot->lot. ' K.O. '.$model->project->location->county0->name, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']). '<hr>';
            }
        } ?>
    </div>
    </div>