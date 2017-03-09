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
<?= Alert::widget() ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
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


