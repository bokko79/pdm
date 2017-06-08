<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lista projekata');
$this->params['breadcrumbs'][] = $this->title;


$coord = new LatLng(['lat' => 45.242463, 'lng' => 19.835804]);
$map = new Map([
    'center' => $coord,
    'zoom' => 12,
    
]);

$map->width = '100%';
$map->height = '480';


// Lets add a marker now
foreach(\common\models\Projects::find()->where('status="active" and visible="1"')->all() as $key=>$project){
  $marker[$key] = new Marker([
      'position' => new LatLng(['lat' => $project->location->lat, 'lng' => $project->location->lng]),
      'title' => $project->name,
  ]);
  // Provide a shared InfoWindow to the marker
  $marker[$key]->attachInfoWindow(
      new InfoWindow([
          'content' => Html::a($project->name, ['/projects/view', 'id'=>$project->id], ['class' => ''])
      ])
  );
  // Add marker to the map
  $map->addOverlay($marker[$key]);
}
  
?>    
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
    	<h5><i class="fa fa-filter"></i> Filter</h5><br>
    	<?= $this->render('_search', ['model' => $searchModel]); ?>
      <div class="card_container record-full grid-item fadeInUp no-shadow animated-not " id="">
        <div class="secondary-context no-padding">
          <div class="media-screen no-margin" id="gmap0-map-canvas">                   
            <?php $map->display() ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-9">
    	<h1><?= $this->title ?></h1>
    	<?php echo ListView::widget([
			    'dataProvider' => $dataProvider,
			    'itemView' => '_project',
          //'itemOptions' => ['style'=>'float:left;'],

			]); ?>
    
</div>
    <?php /*
      <div class="card_container record-full grid-item fadeInUp animated" id="">
          <div class="primary-context gray normal">
              <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?>
              <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Kreiraj novi projekat'), ['create'], ['class' => 'btn btn-primary shadow']) ?>
                  </div>
              </div>
              <div class="subhead">Lista Vaših projekata.</div>
          </div>              
          <div class="secondary-context">
              
          
      <?php Pjax::begin(); ?>    
        <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  'code',
                  [
                     'attribute'=>'name',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a(yii\helpers\StringHelper::truncate($data->name,35), ['/projects/view', 'id'=>$data->id]);
                      },
                  ],
                  [
                     'attribute'=>'client.name',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a(yii\helpers\StringHelper::truncate($data->client->name,35), ['/clients/view', 'id'=>$data->client_id]);
                      },
                  ],
                  /*[
                     'attribute'=>'building_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->building->class;
                      },
                  ],
                  //'building.category',
                  [
                     'attribute'=>'location.city.town',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->location->city->town;
                      },
                  ],
                  // 'location_id',
                  //'work',
                  [
                     'attribute'=>'phase',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->projectPhase;
                      },
                  ],
                  [
                     'attribute'=>'work',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->projectTypeOfWorks;
                      },
                  ],
                  [
                     'attribute'=>'practice.name',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a(yii\helpers\StringHelper::truncate($data->practice->name,35), ['/practices/view', 'id'=>$data->practice_id]);
                      },
                  ],
                  /*[
                     'attribute'=>'engineer_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                      },
                  ],
                  // 'location_access_id',
                  // 'location_services_id',
                  // 'city',
                  // 'status',
                  // 'time',

                  ['class' => 'yii\grid\ActionColumn'],
              ],
          ]); ?>
      <?php Pjax::end(); ?>
          </div>              
      </div>      
    </div>*/ ?>
  </div>
</div>
