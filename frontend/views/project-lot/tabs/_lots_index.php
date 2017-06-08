<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="location-lots">
    <div class="primary-context normal top-bordered aliceblue">
        <div class="head lower">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-link']) ?></div>
            Građevinske parcele
        </div>      
        <div class="subhead">Katastarske parcele na kojima se predviđa/nalazi predmetni objekat.</div>              
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">             
        <?php if($lots = $model->project->location->locationLots){
            foreach($lots as $lot){
                echo '<li>'.Html::a('Katastarska parcela broj '.$lot->lot .'<div class="subtext">K.O. '.$lot->location->county0->name.'</div>', Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => '']). '</li>';
            }
        } else {
            echo '<li>Nije uneta nijedna katastarska parcela.</li>';
            } ?>
        </ul>
    </div>
    <div class="primary-context normal top-bordered aliceblue">
        <div class="head lower">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-link']) ?></div>
            Parcele instalacija
        </div>    
        <div class="subhead">Katastarske parcele preko kojih prolaze priključci objekta na infrastrukturu.</div>                     
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($lots = $model->project->location->serviceLots){
            foreach($lots as $lot){
                echo '<li>'.Html::a('Katastarska parcela broj '.$lot->lot .'<div class="subtext">K.O. '.$lot->location->county0->name.'</div>', Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => '']). '</li>';
            }
        } else {
            echo '<li>Nije uneta nijedna parcela instalacija.</li>';
            } ?>
        </ul>
    </div>
    <div class="primary-context normal top-bordered aliceblue">
        <div class="head lower">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-link']) ?></div>
            Parcele pristupa
        </div>                    
        <div class="subhead">Katastarske parcele preko kojih se pristupa predmetnoj parceli.</div>   
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($lots = $model->project->location->accessLots){
            foreach($lots as $lot){
                echo '<li>'.Html::a('Katastarska parcela broj '.$lot->lot .'<div class="subtext">K.O. '.$lot->location->county0->name.'</div>', Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => '']). '</li>';
            }
        } else {
            echo '<li>Nije uneta nijedna parcela pristupa.</li>';
            } ?>
        </ul>
    </div>
    </div>