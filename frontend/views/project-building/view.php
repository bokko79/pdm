<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = c($model->name) . ': ' . $model->state;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projects/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;

$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],
   /* [
        'label'=>'Etaže i prostorije',
        'content'=>$this->render('tabs/_storeys', ['model'=>$model, 'projectBuildingStoreys'=>$projectBuildingStoreys]),
    ],*/
    [
        'label'=>'Klase',
        'content'=>$this->render('tabs/_classes', ['model'=>$model, 'projectBuildingClasses'=>$projectBuildingClasses]),
    ],
    [
        'label'=>'Visine',
        'content'=>$this->render('tabs/_heights', ['model'=>$model, 'projectBuildingHeights'=>$projectBuildingHeights]),
    ],
   /* [
        'label'=>'Delovi',
        'content'=>$this->render('tabs/_parts', ['model'=>$model, 'projectBuildingParts'=>$projectBuildingParts]),
    ],*/
    [
        'label'=>'Arhitektura',
        'content'=>$this->render('tabs/_characteristics', ['model'=>$model]),
    ],
    [
        'label'=>'Konstrukcija',
        'content'=>$this->render('tabs/_structure', ['model'=>$model]),
    ],
    [
        'label'=>'Materijali',
        'content'=>$this->render('tabs/_materials', ['model'=>$model]),
    ],
    [
        'label'=>'Izolacije',
        'content'=>$this->render('tabs/_insulations', ['model'=>$model]),
    ],
    [
        'label'=>'Instalacije',
        'content'=>$this->render('tabs/_services', ['model'=>$model]),
    ],
    
    ];
if($model->project->work!='promena_namene' and $model->project->work!='ozakonjenje' and $model->project->work!='adaptacija'){
    $items[] = [
        'label'=>'Stolarija i bravarija',
        'content'=>$this->render('tabs/_doorwin', ['model'=>$model, 'projectBuildingDoorwin'=>$projectBuildingDoorwin]),
    ];
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                    'containerOptions'=>[
                        'style' => 'width:100%;min-height:390px;',
                    ],
                ]);
            ?>
        </div>  
    </div>
</div>