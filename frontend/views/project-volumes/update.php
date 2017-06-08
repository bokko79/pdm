<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = 'Podešavanje sveske projekta';

$this->params['page_title'] = 'Projekat';
$this->params['page_title_2'] = c($model->name);
$this->params['page_title_3'] = 'Podešavanje';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-book"></i> Sveske projekta', 'url' => ['/project-volumes', 'ProjectVolumesSearch[project_id]' => $model->project_id]];
$this->params['breadcrumbs'][] = ['label' => c($model->name), 'url' => ['/project-volumes/view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
  <div class="primary-context normal aliceblue bottom-bordered">
    <div class="head colos">
      <div class="subaction">
        <?= Html::a('<i class="fa fa-bars fa-2x"></i>', Url::to(['/project-volumes/index', 'ProjectVolumesSearch[project_id]'=>$model->project->id]), ['class' => 'btn btn-link']) ?>
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
        	<h4><i class="fa fa-cog"></i> <?= $this->title ?></h4>
			<hr style="margin: 10px 0 40px">
		    <?= $this->render('_form', [
		        'model' => $model,
            'project' => $model->project,
		    ]) ?>

		</div>
    </div>
</div>


