<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectVolumesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sveske projekta';

$this->params['page_title'] = 'Projekat';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-book"></i> Sveske projekta', 'url' => ['/project-volumes', 'ProjectVolumesSearch[project_id]' => $model->id]];


$this->params['project'] = $model;

$setup = true;
$haystack = [];
$r_haystack = [];
$phase_volumes = \common\models\PhaseVolumes::find()->where('phase="'.$model->phase.'" and building_category="'.$model->building->category.'"')->all();
foreach($phase_volumes as $pv){
  $haystack[] = $pv->volume_id;
}

if($model->projectVolumes){
  foreach($model->projectVolumes as $projectVolume){  
    $r_haystack[] = $projectVolume->volume_id;                  
    if(!in_array($projectVolume->volume_id, $haystack)){$setup=false;}
  }
} else {
  $setup=false;
}
foreach($haystack as $needle){                    
  if(!in_array($needle, $r_haystack)){$setup=false;}
}
  
$sign = null;

$v_id = [];
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
  <div class="primary-context normal aliceblue bottom-bordered">
    <div class="head colos">
      <div class="subaction">
        <?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-volumes/create', 'ProjectVolumesSearch[project_id]'=>$model->id]), ['class' => 'btn btn-link']) ?>
        <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
      </div>
      <i class="fa fa-book"></i> Sveske projekta
    </div>
    <div class="subhead">Upravljanje učesnicima na projektu.</div>
  </div>  
  <div class="primary-context aliceblue bottom-bordered" style="display: none;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 text">
          <h5>Upravljanje učesnicima projekta</h5>
          <h6>Nova sveska projekta.</h6>
          <p>Nova sveska projekta.</p>
          <h6>Podešavanje sveske projekta.</h6>
          <p>Podešavanje sveske projekta.</p>
          <h6>Uklanjanje sveske projekta.</h6>
          <p>Uklanjanje sveske projekta.</p>
        </div>
        <div class="col-sm-7">
          <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
        </div>
      </div>
    </div>        
  </div>
</div>
    
<div class="container-fluid listed">
    <div class="row">
        <div class="index w300">
            <button type="button" class="navbar-toggle navbar-toggle-sidebar-inside" data-toggle="collapse" data-target="#navbar-collapser" aria-expanded="true">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="card_container record-full grid-item no-margin no-padding no-shadow hidden-md" id="navbar-collapser">
              <div class="primary-context gray">   
                  <div class="head third">
                    <div class="subaction"><a href="#" class="float-right button_to_show_secondary"><i class="fa fa-search fa-lg"></i></a></div>
                    <i class="fa fa-filter"></i> Filter   
                  </div>      
              </div>
              <div class="primary-context gray low-margin top-bordered" style="display: none;">   
                  <?php echo $this->render('_search', ['model' => $searchModel, 'project' => $model]); ?>          
              </div>
              <div class="secondary-context no-padding">        
                  <?php echo ListView::widget([
                      'dataProvider' => $dataProvider,
                      'itemView' => '_volume',
                      'itemOptions' => ['tag'=>'ul', 'class'=>'index-menu'],
                      'summary' => '',
                      'emptyText' => '<ul class="index-menu"><li>Nije pronađena nijedna sveska.</li></ul>',
                  ]); ?>        
              </div>                
            </div>       
        </div>
        <div class="content view w300 ">
            
            <ul class="bg-info text-info disc" style="margin-bottom: 20px">
              Za ovaj projekat, vrstu radova (<?= $model->projectTypeOfWorks ?>), fazu projetka (<?= $model->projectPhase ?>) i kategoriju objekta (<?= $model->building->category ?>), <b class="">potrebni</b> su sledeći delovi projektne dokumentacije:
              <?php foreach($phase_volumes as $key=>$phase_volume): 
                if($model->projectVolumes){
                  foreach($model->projectVolumes as $projectVolume){
                    if($projectVolume->volume_id==$phase_volume->volume_id){
                      $sign = '<i class="fa fa-check-circle fa-lg color-green-900"></i>';
                      $v_id[$key] = $projectVolume->id;
                      break;                 
                    } else {
                      $sign = '<small class="hint"><i class="'.(($phase_volume->requirement) ? 'fa fa-warning red' : '').'"></i> '.(($phase_volume->requirement) ? 'Sveska je OBAVEZNA! ' : 'Sveska je opciona. ' ).Html::a('<i class="fa fa-plus-circle"></i> Dodaj svesku', ['create', 'ProjectVolumesSearch[project_id]'=>$model->id, 'ProjectVolumesSearch[volume_id]'=>$phase_volume->volume_id], []). '</small>';
                    }
                  }
                } else {
                  $sign = '<small class="hint"><i class="'.(($phase_volume->requirement) ? 'fa fa-warning red' : '').'"></i> '.(($phase_volume->requirement) ? 'Sveska je OBAVEZNA! ' : 'Sveska je opciona. ' ).Html::a('<i class="fa fa-plus-circle"></i> Dodaj svesku', ['create', 'ProjectVolumesSearch[project_id]'=>$model->id, 'ProjectVolumesSearch[volume_id]'=>$phase_volume->volume_id], []). '</small>';
                }
                   ?>

                <li class=""><?= isset($v_id[$key]) ? Html::a('<b>'.c($phase_volume->volume->name) . '</b> '. $sign, ['view', 'id'=>$v_id[$key]], []) : '<b>'.c($phase_volume->volume->name) . '</b> '. $sign ?></li>
              <?php endforeach; ?>
            </ul>
 
            <?php if($model->setup_status=='volumes' and $setup): ?>
              <div class="card_container record-full grid-item no-margin no-padding no-shadow">
                <div class="primary-context bordered text aliceblue">
                  <p>Kada završite unos svezaka, odnosno delova projekta, pređite na sledeći korak.</p>
                  <?php $form = kartik\widgets\ActiveForm::begin([
                      'id' => 'step-form-volumes',
                      'type' => ActiveForm::TYPE_HORIZONTAL,
                      'fullSpan' => 10,      
                      'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                      'options' => ['enctype' => 'multipart/form-data'],
                  ]); ?>
                    <div class="row" style="margin:50px 0 0;">                
                      <div class="col-md-12">                            
                        <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
                      </div>            
                    </div>
                  <?php ActiveForm::end(); ?>
                </div>
              </div>
            <?php endif; ?>

        </div>
    </div>
</div>
