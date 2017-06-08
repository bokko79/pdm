<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

$items = [];
$items[] = ['label' => '<i class="fa fa-bars"></i> Index spratova ('.$model->state.')' , 'url' =>['/project-building-storeys/index', 'id'=>$model->id], 'linkOptions'=>['style'=>'font-weight:bold; font-size:13px;']];
if($storeys = $model->projectBuildingStoreys){
    foreach($storeys as $storey){
        $subitems = [];
        if($parts = $storey->projectBuildingStoreyParts){
            $netCheck = false;
            foreach($parts as $part){
                $subitems[] = ['label' => (($part->netArea==0) ? '<i class="fa fa-warning red"></i> ' : null).c($part->name). ' '.$part->mark.' ('. $part->netArea.' m<sup>2</sup>)', 'url' =>['/project-building-storey-parts/view', 'id'=>$part->id]];
                if($part->netArea==0){
                    $netCheck = true;
                }                
            }  
            $items[] = ['label' => (($netCheck) ? '<i class="fa fa-warning red"></i> ' : null).c($storey->name).' @'.$storey->level, 'items'=>$subitems, 'url' =>['/project-building-storeys/view', 'id'=>$storey->id], 'active'=>(($unit and $unit->project_building_storey_id == $storey->id) or Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storeys/view?id='.$storey->id]))];
        } else {
            $items[] = ['label' => '<i class="fa fa-warning red"></i> '. c($storey->name).' @'.$storey->level, 'url' =>['/project-building-storeys/view', 'id'=>$storey->id]];
        }
        
                            
    }
}
?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="secondary-context no-padding">
<?php
    echo Nav::widget([
        'options'=>['class'=>'index-menu', 'style'=>''],
        'encodeLabels' => false,
        'items' => $items,
    ]);
?>
    </div>
</div>