<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($existings = $model->project->projectLotExistingBuildings){
            foreach($existings as $existing){
                echo '<li>'.Html::a(c($existing->buildingType->name. ' ('.$existing->storeys.') ').'<div class="subtext">Oznaka objekta: '.$existing->mark.'</div>', Url::to(['/project-lot-existing-buildings/update', 'id'=>$existing->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan postojeći objekat.</li>';
            } ?>
        </ul>
    </div>
</div>