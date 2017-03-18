<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\widgets\Alert;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = $model->number. '. '.c($model->name);
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
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
$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('tabs/_general', ['model'=>$model, 'sveska'=>$sveska]),
        'active'=>true
    ],
    [
        'label'=>'Crteži i tablice',
        'content'=>$this->render('tabs/_drawings', ['model'=>$model, 'projectVolumeDrawings'=>$projectVolumeDrawings]),
    ],
]; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <?= $this->render('_menu', [
                    'model' => $model->project,  
                ]) ?>        
        </div>
        <div class="col-sm-9">
            <div class="" style="margin:20px 20px 40px;">
                <?php if($model->volume->type!='drugo' or $model->volume_id==1): 
                  if($model->dataRequirement($model->dataReqs())): ?>
                  <?= Html::a('<i class="fa fa-print"></i> '.c($model->name), Url::to(['/site/'.$sveska, 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary btn-lg shadow', 'target'=>'_blank']) ?>
                  <?php else: ?>
                    <?= Html::button('<i class="fa fa-print"></i> '.c($model->name), ['class' => 'btn btn-disabled btn-lg', 'disabled'=>true]) ?>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if($model->projectVolumeDrawings): ?>
                  <?= Html::a('<i class="fa fa-print"></i> Tablice crteža', Url::to(['/site/tablice', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-default btn-lg shadow', 'target'=>'_blank']) ?>
                  <?php endif; ?> 
                  <?php if($model->volume_id==2): ?>
                  <?= Html::a('<i class="fa fa-print"></i> Površine prostorija', Url::to(['/site/povrsine', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-default btn-lg shadow', 'target'=>'_blank']) ?>
                <?php endif; ?>
            </div>
                
            <?= Alert::widget() ?>
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


