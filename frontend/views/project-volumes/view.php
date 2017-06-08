<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\widgets\Alert;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\tabs\TabsX;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = $model->number. '. '.c($model->name);

$this->params['page_title'] = 'Projekat';
$this->params['page_title_2'] = c($model->name);

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-book"></i> Sveske projekta', 'url' => ['/project-volumes', 'ProjectVolumesSearch[project_id]' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;


if($model->volume_id==1) { 
    $sveska = 'glavna-sveska'; 
  } elseif($model->volume_id==17) { 
    $sveska = 'izvod'; 
  } elseif($model->volume_id==19) { 
    $sveska =  'ozakonjenje'; 
  } else { 
    $sveska = 'projekat'; 
  }
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
  <div class="primary-context normal aliceblue bottom-bordered">
    <div class="head colos">
      <div class="subaction">
        <?= Html::a('<i class="fa fa-bars fa-2x"></i>', Url::to(['/project-volumes/index', 'ProjectVolumesSearch[project_id]'=>$model->project_id]), ['class' => 'btn btn-link']) ?>
        <?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-volumes/create', 'ProjectVolumesSearch[project_id]'=>$model->project_id]), ['class' => 'btn btn-link']) ?>
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
                  <?php echo $this->render('_search', ['model' => $searchModel, 'project' => $model->project]); ?>          
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
            
        
            
            <div class="card_container record-full grid-item fadeInUp animated-not no-shadow" id="">
              <div class="primary-context gray normal">
                  <div class="head">
                  <div class="subaction">
                    <?php if($model->volume->type!='drugo' or $model->volume_id==1): 
                      if($model->dataRequirement($model->dataReqs())): ?>
                      <?= Html::a('<i class="fa fa-file-pdf-o fa-2x"></i>', Url::to(['/site/'.$sveska, 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-link', 'target'=>'_blank']) ?>
                      <?php endif; ?>
                        <?= Html::a('<i class="fa fa-image fa-2x"></i>', Url::to(['/project-volume-drawings/index', 'ProjectVolumeDrawings[project_volume_id]'=>$model->id]), ['class' => 'btn btn-link']) ?>
                    <?php endif; ?>
                    <?= Html::a(Yii::t('app', '<i class="fa fa-cogs fa-2x"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?> 

                  <?php /* if($model->volume->type!='drugo' or $model->volume_id==1): 
                    if($model->dataRequirement($model->dataReqs())): ?>
                    <?= Html::a('<i class="fa fa-print"></i> PDF Sveske', Url::to(['/site/'.$sveska, 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary', 'target'=>'_blank']) ?>
                    <?php else: ?>
                      <?= Html::button('<i class="fa fa-print"></i> PDF Sveske', ['class' => 'btn btn-disabled', 'disabled'=>true]) ?>
                    <?php endif; ?>
                  <?php endif; */?>
                  <?php /* Html::a(Yii::t('app', '<i class="fa fa-power-off"></i>'), ['delete', 'id' => $model->id], [
                      'class' => 'btn btn-danger shadow',
                      'data' => [
                          'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                          'method' => 'post',
                      ],
                  ]) */ ?>
                      </div>
                      <i class="fa fa-file"></i> <?= Html::encode($this->title) ?>
                  </div>
                  <div class="subhead">Deo projektne dokumentacije.</div>
                  
              </div>
              <div class="secondary-context gray cont">
              <?php if($model->project->setup_status==''): ?>
                <?= Alert::widget() ?>
              <?php endif; ?>
              </div>
              <div class="secondary-context">
                  
                  <div class="" style="margin:20px 20px 40px;">
                    <?php if($model->volume->type!='drugo' or $model->volume_id==1): 
                      if($model->dataRequirement($model->dataReqs())): ?>
                      <?= Html::a('<i class="fa fa-file-pdf-o"></i> PDF '.c($model->name), Url::to(['/site/'.$sveska, 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary btn-lg shadow', 'target'=>'_blank']) ?>
                      <?php else: ?>
                        <?= Html::button('<i class="fa fa-file-pdf-o"></i> PDF: '.c($model->name), ['class' => 'btn btn-disabled btn-lg', 'disabled'=>true]) ?>
                      <?php endif; ?>
                        <?= Html::a('<i class="fa fa-image"></i> Crteži i tablice', Url::to(['/project-volume-drawings/index', 'ProjectVolumeDrawings[project_volume_id]'=>$model->id]), ['class' => 'btn btn-info btn-lg shadow']) ?>
                    <?php endif; ?>
                    <?php /* if($model->projectVolumeDrawings): ?>
                      <?= Html::a('<i class="fa fa-print"></i> Tablice crteža', Url::to(['/site/tablice', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-default btn-lg shadow', 'target'=>'_blank']) ?>
                      <?php endif; ?> 
                      <?php if($model->volume_id==2): ?>
                      <?= Html::a('<i class="fa fa-print"></i> Površine prostorija', Url::to(['/site/povrsine', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-default btn-lg shadow', 'target'=>'_blank']) ?>
                    <?php endif; */ ?>
                  </div>
                  <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'number',
                        'name',
                        'code',
                        [
                           'attribute'=>'practice_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                            },
                        ],
                        [
                           'attribute'=>'engineer_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                            },
                        ],
                        [
                           'attribute'=>'engineer_licence_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return Html::a($data->engineerLicence->no, ['/engineer-licences/update', 'id'=>$data->engineer_licence_id]);
                            },
                        ],
                        [
                           'attribute'=>'control_practice_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return $data->controlPractice ? Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]) : null;
                            },
                        ],
                        [
                           'attribute'=>'control_engineer_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return $data->controlEngineer ? Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]) : null;
                            },
                        ],
                        [
                           'attribute'=>'control_engineer_licence_id',
                           'format' => 'raw',
                           'value'=>function ($data) {
                                return $data->controlEngineerLicence ? Html::a($data->controlEngineerLicence->no, ['/engineer-licences/update', 'id'=>$data->control_engineer_licence_id]) : null;
                            },
                        ],
                        
                        'control_text'
                    ],
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
              </div>
            </div>
        </div>  
    </div>
</div>


