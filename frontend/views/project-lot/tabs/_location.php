<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$coord = new LatLng(['lat' => $model->project->location->lat, 'lng' => $model->project->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 15,
    
]);

$map->width = '100%';
$map->height = '480';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);
// Add marker to the map
$map->addOverlay($marker);
?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">
        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi lokaciju', Url::to(['/project-lot/location', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?>
            </div>
            <i class="fa fa-map-marker"></i> Lokacija projekta
        </div>
        <div class="subhead"><?= $model->project->location->getLotAddress(false) ?></div>
    </div>
    
      <hr style="margin:0">
      <div class="secondary-context no-padding">
        <div class="media-screen no-margin" id="gmap0-map-canvas">                   
          <?php $map->display() ?>
        </div>
      </div>          
</div>