<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use kartik\tabs\TabsX;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = \yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model;

$formatter = \Yii::$app->formatter;
/*
$items = [    
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],    
    [
        'label'=>'Investitori',
        'content'=>$this->render('tabs/_clients', ['model'=>$model]),
    ],
    [
        'label'=>'Dokumenti i podloge',
        'content'=>$this->render('tabs/_docs', ['model'=>$model]),
    ],
    [
        'label'=>'<i class="fa fa-envelope-o"></i> Poruke',
        'content'=>$this->render('tabs/_todo', ['model'=>$model]),
    ],
    /*[
        'label'=>'Tehnička dokumentacija',
        'content'=>$this->render('tabs/_volumes', ['model'=>$model]),
    ],
];*/

$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;

$coord = new LatLng(['lat' => $model->location->lat, 'lng' => $model->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 15,
    
]);

$map->width = '100%';
$map->height = '220';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);
// Add marker to the map
$map->addOverlay($marker);
?>

<div class="container-fluid">
  <div class="row">
    

  <div class="col-sm-7">
    <?php // objekat ?>

    <div class="card_container record-full grid-item fadeInUp no-shadow animated-not " id="">
      <div class="secondary-context">
        <div class="head major">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Projekat
          <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
            <div class="action-area normal-case">
              <?= Html::a('<i class="fa fa-cog"></i>', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-default shadow btn-sm']) ?>                   
            </div> 
          <?php endif; ?>
          </div>                  
            <?= $model->name ?>
            
            <p>Investiciona vrednost objekta: <?= $formatter->asDecimal($model->projectExBuilding ? $model->projectExBuilding->cost : $model->projectBuilding->cost) ?> RSD</p>
            <p>Datum početka i završetka građenja: <?= $formatter->asDate($model->start_date, 'php: F Y.') ?> - <?= $formatter->asDate($model->end_date, 'php: F Y.') ?></p>
        </div>              
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat
          <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
            <div class="action-area normal-case">
              <?= Html::a('<i class="fa fa-cog"></i>', Url::to(['/project-building/update', 'id'=>$model->id]), ['class' => 'btn btn-default shadow btn-sm']) ?>                   
            </div>  
          <?php endif; ?>
          </div>                  
            <?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($building->name. ' ' .$building->storey, Url::to(['/project-building/view', 'id'=>$building->id]), ['class' => '']) : $building->name. ' ' .$building->storey ?>
            <p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $building->type ?></p>
        </div>              
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin second">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Lokacija
          <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
            <div class="action-area normal-case">
              <?= Html::a('<i class="fa fa-cog"></i>', Url::to(['/project-lot/location', 'id'=>$model->id]), ['class' => 'btn btn-default shadow btn-sm']) ?>                   
            </div>
          <?php endif; ?>
          </div>              
          <?= $model->location->getLotAddress(true) ?>
        </div>
      </div>
      <hr style="margin:0">
      <div class="secondary-context no-padding">
        <div class="media-screen no-margin" id="gmap0-map-canvas">                   
          <?php $map->display() ?>
        </div>
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin lower">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Investitor(i) projekta
          <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
            <div class="action-area normal-case">
              <?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-default shadow btn-sm shadow']) ?>                   
            </div>
          <?php endif; ?>
          </div>
          <?php if($projectClients = $model->projectClients){
            foreach($projectClients as $projectClient){
              $client = $projectClient->client;
              echo (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => '']) : $client->name. ', <small class="hint" style="font-size:70%">'.$client->location->fullAddress. '</small><br>';
            }
          } ?>

        </div>              
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin lower">
          <div class="subhead uppercase hint" style="margin-bottom:5px;">Projektant</div>              
          <?= Html::a($model->practice->name, Url::to(['/practices/view', 'id'=>$model->practice_id]), ['class' => '']) ?>
        </div>
        <div class="head thin second"> 
          <?= Html::a($model->engineer->name, Url::to(['/engineers/view', 'id'=>$model->engineer_id]), ['class' => '']) ?>, <?= $model->engineer->expertees->short ?>
        </div>              
      </div>
    </div>

    
     
      </div>

      <div class="col-sm-5">
    <?php 
        $fotorama = \metalguardian\fotorama\Fotorama::begin(
          [
            'options' => [
                'loop' => true,
                'hash' => true,
                'allowfullscreen' => true,
                'width' => '100%',
                'minwidth' => '400',
                'maxwidth' => '445',
                'minheight' => '356',
                'maxheight' => '100%',
                'height' => '356',
                'ratio' => 445/356,
                'nav' => false,
                //'fit' => 'cover',
            ],
            //'tagName' => 'span',
            'useHtmlData' => false,
            'htmlOptions' => [
                'style'=>'',
                'class'=>'card-width-cover'
            ],
          ]
        );  ?>
        <?php foreach ($model->projectFiles as $media): ?>
            <?= $media->file->type=='jpg' ? Html::img('@web/images/projects/'.$model->year.'/'.$model->id.'/'.$media->file->name) : null ?>
        <?php endforeach; ?>
        <?php $fotorama->end(); ?>
<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
    <?php // sveske ?>
    <div class="card_container record-full grid-item fadeInUp no-shadow animated-not" id="" style="margin-top: 30px;">
      <div class="secondary-context">
        <div class="head thin lower">
          <div class="subhead uppercase hint">Sveske projekta
          <div class="action-area normal-case">
            <?= Html::a('<i class="fa fa-bars"></i>', Url::to(['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-default btn-sm']) ?>                   
          </div>                    
            </div>
        </div> 
        <?php if($projectVolumes = $model->projectVolumes){
            foreach($projectVolumes as $projectVolume){
              $volume = $projectVolume->volume;
              echo Html::a($projectVolume->name, Url::to(['/project-volumes/view', 'id'=>$projectVolume->id]), ['class' => '']);
            }
          } ?>             
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin second">
          <div class="subhead uppercase hint">Dokumenti projekta             
          <div class="action-area normal-case">
            <?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-default shadow btn-sm']) ?>                   
          </div>
          </div> 
        </div>
        <?php if($projectFiles = $model->projectFiles){
            foreach($projectFiles as $projectFile){
              echo Html::a($projectFile->type, Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => '']);
            }
          } else {
              echo 'Ovaj projekat nema prikačenih dokumenata.';
          } ?>
      </div>
    </div>
  <?php endif; ?>

  </div>

  </div>
</div>

<?php /*
    <div class="row">
        <div class="col-sm-12">        

            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false,
                ]);
            ?>
        </div>  
    </div>
</div>
*/ ?>

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Podestnik projekta</h2>',
    'id'=>'todolist',
]);

echo 'Napravi podsetnik.';

\yii\bootstrap\Modal::end();