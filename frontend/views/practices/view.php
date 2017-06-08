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

$check_engineers = [];
$check_partners = [];
if(!Yii::$app->user->isGuest and Yii::$app->user->engineer){
  if(Yii::$app->user->engineer->practiceEngineers){
    foreach (Yii::$app->user->engineer->practiceEngineers as $key => $value) {
      $check_engineers[] = $value->practice_id;
    }
  }

  if(Yii::$app->user->engineer->practice and Yii::$app->user->engineer->practice->practicePartners){
    foreach (Yii::$app->user->engineer->practice->practicePartners as $key => $value) {
      $check_partners[] = Yii::$app->user->id==$value->practice_id ? $value->partner_id : $value->practice_id;
    }
  }
}
  
?>

  <div class="row" style="margin-bottom:30px;">
    <div class="col-sm-3">
    

    <?php // sveske ?>
    <div class="card_container record-full grid-item" id="">
      <?php if(!Yii::$app->user->isGuest and (!in_array($model->engineer_id, $check_engineers) or !in_array($model->engineer_id, $check_partners))): ?>
         
      <?php if(Yii::$app->user->engineer and !Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_engineers)): ?>    
        <div class="secondary-context"> 
            <?= Html::a('<i class="fa fa-plus-circle"></i> Postani inženjer firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>$model->engineer_id, 'PracticeEngineersSearch[engineer_id]'=>\Yii::$app->user->id, 'PracticeEngineersSearch[status]'=>'to_join']), ['class' => 'btn btn-default btn-sm btn-block']) ?>
        </div>
      <?php endif; ?>
      <?php if(Yii::$app->user->engineer and Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_partners) and Yii::$app->user->id!=$model->engineer_id): ?> 
        <div class="secondary-context"> 
            <?= Html::a('<i class="fa fa-plus-circle"></i> Postani partner firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-partners/create', 'PracticePartners[practice_id]'=>\Yii::$app->user->id, 'PracticePartners[partner_id]'=>$model->engineer_id, 'PracticePartners[status]'=>'invited']), ['class' => 'btn btn-default btn-sm btn-block']) ?>  
        </div> 
      <?php endif; ?>              
      
      
      <hr style="margin:0">
    <?php endif; ?>
      <div class="secondary-context gray">
        <div class="head thin second">
          <div class="subhead uppercase hint" style="margin-bottom: 5px;">Kontakt
          </div>              
          
        </div>
        <div class="muted">
            <table>
              <tr>
                <td style="padding:3px"><i class="fa fa-map-marker"></i></td><td style="padding:3px"><?= $model->location->getFullAddress(true) ?></td>
              </tr>
              <tr>
                <td style="padding:3px"><i class="fa fa-at"></i></td><td style="padding:3px"><?= $model->email ?></td>
              </tr>
              <tr>
                <td style="padding:3px"><i class="fa fa-phone"></i></td><td style="padding:3px"><?= $model->phone ?></td>
              </tr>
              <tr>
                <td style="padding:3px"><i class="fa fa-fax"></i></td><td style="padding:3px"><?= $model->fax ?></td>
              </tr>
            </table>
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
        <div class="muted">
            <table>
              <tr>
                <td style="padding:3px;font-weight:700;">PIB:</td><td style="padding:3px"><?= $model->tax_no ?></td>
              </tr>
              <tr>
                <td style="padding:3px;font-weight:700;">MB:</td><td style="padding:3px"><?= $model->company_no ?></td>
              </tr>
              <tr>
                <td style="padding:3px;font-weight:700;">Br.rčn:</td><td style="padding:3px"><?= $model->account_no ?></td>
              </tr>
              <tr>
                <td style="padding:3px;font-weight:700;">Banka:</td><td style="padding:3px"><?= $model->bank ?></td>
              </tr>
            </table>              
        </div>
      </div>
    </div>
  </div>

    <div class="col-sm-6">
      <?php // opis ?>

      <div class="card_container record-full grid-item fadeInUp no-shadow animated-not " id="">
        <div class="secondary-context">
          <div class="muted">
            <div class="subhead uppercase hint" style="margin-bottom: 5px;">Opis
            <div class="action-area normal-case">
              <?= (\Yii::$app->user->can('updateOwnPractice', ['practice_engineer'=>$model])) ? Html::a('<i class="fa fa-pencil"></i>', Url::to(['/practices/update', 'id'=>$model->engineer_id]), ['class' => 'btn btn-default btn-sm']) : null ?>                   
            </div>  
            </div>                  
              <?= ($model->about) ?: 'Nije unet opis firme.' ?>
              
          </div>              
        </div>
        <hr style="margin:0">      
       
        
       
      </div>
      <div class="card_container record-full transparent top-bordered grid-item fadeInUp no-shadow animated-not " id="">
        <div class="primary-context">
          <div class="head">            
              <div class="subaction">
                  <?= Html::a('<i class="fa fa-bars"></i> Svi projekti firme', Url::to(['/projects/index', 'ProjectsSearch[practice_id]'=>$model->engineer_id]), ['class' => 'btn btn-default btn-sm']) ?>                   
              </div>
              Najnoviji projekti
          </div>              
        </div>  
      </div>
      <?php echo ListView::widget([
              'dataProvider' => $projects,
              'itemView' => '_project',
              'layout' => '{items}',
          ]); ?>

        <hr> 
      <div class="card_container record-full transparent  grid-item fadeInUp no-shadow no-margin animated-not" id="">
        <div class="primary-context">
          <div class="head">

            <?php if(!Yii::$app->user->isGuest and Yii::$app->user->engineer and !Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_engineers) and Yii::$app->user->id!=$model->engineer_id): ?>
              <div class="subaction">
                <?= Html::a('<i class="fa fa-plus-circle"></i> Postani inženjer firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>$model->engineer_id, 'PracticeEngineersSearch[engineer_id]'=>\Yii::$app->user->id, 'PracticeEngineersSearch[status]'=>'to_join']), ['class' => 'btn btn-default btn-sm ']) ?>
              </div>
            <?php endif; ?>
              Inženjeri
          </div>              
        </div> 

      </div>
      <?php echo ListView::widget([
              'dataProvider' => $practiceEngineers,
              'itemView' => '_engineer',
              'layout' => '{items}',
          ]); ?>

      <div class="card_container record-full transparent grid-item fadeInUp no-shadow no-margin animated-not" id="">
        <div class="primary-context">
          <div class="head">
            <?php if(!Yii::$app->user->isGuest and Yii::$app->user->engineer and Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_partners) and Yii::$app->user->id!=$model->engineer_id): ?> 
                <div class="subaction">                    
                  <?= Html::a('<i class="fa fa-plus-circle"></i> Postani partner firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-partners/create', 'PracticePartners[practice_id]'=>\Yii::$app->user->id, 'PracticePartners[partner_id]'=>$model->engineer_id, 'PracticePartners[status]'=>'invited']), ['class' => 'btn btn-danger btn-sm ']) ?>  
                </div>
            <?php endif; ?>
    
              Partneri
          </div>              
        </div> 

      </div>
      <?php echo ListView::widget([
              'dataProvider' => $practicePartners,
              'itemView' => '_partner',
              'layout' => '{items}',
              'viewParams' => ['practice' => $model],
          ]); ?>
     
    </div>
    <div class="col-sm-3">
      <?php if(Yii::$app->user->isGuest or !Yii::$app->user->engineer): ?>
            <?= $this->render('../engineers/_registerAs'); ?>
            <hr>
        <?php endif; ?>
        <div class="card_container record-full grid-item transparent fadeInUp no-shadow animated-not no-margin" id="" style="float:none;">
            <div class="primary-context   no-padding">
                <div class="head lower regular">
                    Slične firme                   
                </div>              
            </div> 
        </div>
        <?php echo ListView::widget([
                      'dataProvider' => $practices,
                      'itemView' => '_practice_short',
                      'layout' => '{items}',
                  ]); ?>
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