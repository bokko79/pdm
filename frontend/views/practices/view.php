<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Practices */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firme'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['profile'] = $model;

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
    //'title' => 'My Home Town',
]);

// Add marker to the map
$map->addOverlay($marker);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
    

    <?php // sveske ?>
    <div class="card_container record-full grid-item fadeInUp no-shadow animated" id="">
      <div class="secondary-context">
        <div class="head thin lower">
          <div class="action-area normal-case">
            <?= Html::a('<i class="fa fa-plus-circle"></i> Join', Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>$model->engineer_id, 'PracticeEngineersSearch[engineer_id]'=>\Yii::$app->user->id, 'PracticeEngineersSearch[status]'=>'to_join']), ['class' => 'btn btn-default shadow btn-sm shadow']) ?>                   
          </div>
          <?= $model->name ?>
        </div>              
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin second">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Kontakt
          </div>              
          
        </div>
        <div class="">
        
            <i class="fa fa-map-marker"></i> <?= $model->location->getFullAddress(true) ?><br>
            
            <i class="fa fa-at"></i> <?= $model->email ?><br>
            <i class="fa fa-phone"></i> <?= $model->phone ?><br>
            <i class="fa fa-fax"></i> <?= $model->fax ?>
        </div>
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin second">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Direktor firme
          </div>
              <?php
              $engineer = $model->director;
              echo Html::a($engineer->name, Url::to(['/engineers/view', 'id'=>$engineer->user_id]), ['class' => '']). ', <small class="hint" style="font-size:70%">'.$engineer->title. '</small><br>'; ?>

        </div>              
      </div>
      <hr style="margin:0">
      <div class="secondary-context">
        <div class="head thin second">
          <div class="subhead uppercase hint">Poslovni podaci</div> 
        </div>
        <div class="">
        
            PIB: <?= $model->tax_no ?><br>            
            MB: <?= $model->company_no ?><br>
            Br. računa: <?= $model->account_no ?><br>
            <i class="fa fa-at"></i>  <?= $model->bank ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-9">
    <?php // objekat ?>

    <div class="card_container record-full grid-item fadeInUp no-shadow animated " id="">
      <div class="secondary-context">
        <div class="head major">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Opis
          <div class="action-area normal-case">
            <?= Html::a('<i class="fa fa-bars"></i>', Url::to(['/practice/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-default shadow btn-sm']) ?>                   
          </div>  
          </div>                  
            <?= $model->about ?>
            
        </div>              
      </div>
      <hr style="margin:0">      
      
      
     
    </div>

    <div class="card_container record-full grid-item fadeInUp transparent no-shadow animated " id="">
      <div class="secondary-context">
        <div class="head major thin">
                            
            Projekti firme
            <div class="action-area normal-case">
                <?= Html::a('<i class="fa fa-cog"></i> Svi projekti firme', Url::to(['/projects/index', 'Projects[practice_id]'=>$model->engineer_id]), ['class' => 'btn btn-link']) ?>                   
            </div>
            
        </div>              
      </div>  
    </div>
        <?php echo ListView::widget([
                'dataProvider' => $projects,
                'itemView' => '../projects/_project',
            ]); ?>
     
      </div>
  </div>
</div>
<?php
/*
$items = [
    [
        'label'=>'<i class="fa fa-shield"></i> Profil',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],    
    [
        'label'=>'<i class="fa fa-file-powerpoint-o"></i> Projekti',
        'content'=>$this->render('tabs/_projects', ['model'=>$model, 'projects'=>$projects]),
    ],
    [
        'label'=>'<i class="fa fa-user-circle-o"></i> Portfolio',
        'content'=>$this->render('tabs/_portfolio', ['model'=>$model]),
    ],
    [
        'label'=>'<i class="fa fa-file-text"></i> Dokumenti',
        'content'=>$this->render('tabs/_docs', ['model'=>$model]),
    ],
     [
        'label'=>'<i class="fa fa-tags"></i> Osoblje',
        'content'=>$this->render('tabs/_staff', ['model'=>$model, 'practiceEngineers' => $practiceEngineers]),
    ],
];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="min-height:300px;">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                ]);
            ?>
        </div>  
    </div>
</div>
*/ ?>