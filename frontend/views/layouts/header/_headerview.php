<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$formatter = \Yii::$app->formatter;
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
?>

 

<div class="row">
    <div class="col-sm-12" style="z-index: 1">
       <div class="card_container record-full grid-item fadeInUp animated-not" id="">
            <div class="primary-context aliceblue normal">
                <div class="head grand">                            
                 <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>   
                    <div class="subaction">
                        <div class="dropdown">
                        
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link"><i class="fa fa-cogs fa-3x"></i> <i class="fa fa-caret-down"></i></a>
                        <?php
                            echo \yii\bootstrap\Dropdown::widget([
                                'encodeLabels' => false,
                                'items' => [
                                    
                                    '<li class="dropdown-header uppercase">Opšti podaci</li>',
                                    ['label' => '<i class="fa fa-cog"></i> Podešavanje projekta', 'url' => ['/projects/update', 'id'=>$model->id], 'linkOptions'=>['style'=>'']],
                                    /*['label' => 'Investitori', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab1']],
                                    ['label' => 'Dokumenti', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab2']],
                                    ['label' => 'Galerija', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab2']],*/


                                    // parcela
                                    '<li class="divider"></li>',
                                    '<li class="dropdown-header uppercase">Tekstualni podaci</li>',
                                    ['label' => '<i class="fa fa-map-marker"></i> Lokacija', 'url' => ['/project-lot/view', 'id'=>$model->id]],

                                    // objekat  
                                    /*($model->work!='nova_gradnja') ? ['label' => $model->projectExBuilding->name. ' (postojeće stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectExBuilding->id]] : '',
                                    ($model->projectBuilding) ? ['label' => $model->projectBuilding->name. ' (predviđeno stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectBuilding->id]] : '',*/
                                    ($model->work!='nova_gradnja') ? ['label' => '<i class="fa fa-cog"></i> Podešavanje objekta', 'url' => ['/project-building/update', 'id'=>$model->projectExBuilding->id], 'linkOptions'=>['style'=>'']] : ['label' => '<i class="fa fa-cog"></i> Podešavanje objekta', 'url' => ['/project-building/update', 'id'=>$model->projectBuilding->id], 'linkOptions'=>['style'=>'']],

                                    // jedinice
                                    /*($model->work=='adaptacija') ?                                            
                                        ['label' => c($model->projectExUnit->fullType). ' (postojeće stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectExUnit->id]] : '',
                                    ($model->work=='adaptacija') ?     
                                        ['label' => c($model->projectUnit->fullType). ' (predviđeno stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectUnit->id]] : '',*/
                                    ($model->work=='adaptacija') ?         
                                        ['label' => 'Podešavanje jedinice', 'url' => ['/project-building-storey-parts/update', 'id'=>$model->projectExUnit->id]] : '',

                                    '<li class="divider"></li>',
                                    '<li class="dropdown-header uppercase">Numerički podaci</li>',
                                    ($model->work!='nova_gradnja' and $model->work!='adaptacija') ? ['label' => 'Površine (postojeće stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectExBuilding->id, '#'=>'w10-tab1']] : '', 
                                    ($model->projectBuilding) ? ['label' => 'Površine (predviđeno stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuilding->id, '#'=>'w10-tab1']] : '',
                                    ($model->work!='promena_namene' and $model->work!='ozakonjenje') ?
                                    ['label' => '<i class="fa fa-calculator"></i> Predmer', 'url' => ['/project-qs/index', 'ProjectQs[project_id]'=>$model->id], 'active'=>(Yii::$app->controller->id == 'project-qs')] : '',
                                    ($model->work!='promena_namene' and $model->work!='ozakonjenje') ?
                                    ['label' => '<i class="fa fa-calculator"></i> Šeme stolarije i bravarije', 'url' => ['/project-building-doorwin/index', 'ProjectBuildingDoorwin[project_building_id]'=>$model->id], 'active'=>(Yii::$app->controller->id == 'project-building-doorwin')] : '',

                                    '<li class="divider"></li>',
                                    '<li class="dropdown-header uppercase">Preuzimanje dokumentacije</li>',
                                    ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]],
                                    
                                ],
                                'options' => [
                                    'class' => 'dropdown-menu-right',
                                ],
                            ]);
                        ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="subhead" style="margin-bottom:10px;">
                        <div class="label label-default fs_12 regular"><?= $model->type. ($model->type=='project' ? ': '.$model->code : '') ?></div>
                        <div class="label label-<?= $model->status=='active' ? 'success' : 'warning' ?> fs_12 regular"><?= $model->status=='active' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></div>
                        <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_12 regular"><?= $model->visible ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>' ?></div>
                    </div>

                    <?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model] and $model->type=='project') ? $model->code. ': ' : null).\yii\helpers\StringHelper::truncate($model->name, 40) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null) ?>
                </div>
                <div class="subhead"><?= $model->projectTypeOfWorks ?><?= ($model->type=='project') ? ' | faza: '. $model->projectPhase : null ?></div>
            </div>
        </div> 
    </div>
</div>
        <?php /*
        <div class="row">
            <div class="col-sm-12">
                <?php
                
                    echo Nav::widget([
                        'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000'],
                        'encodeLabels' => false,
                        'items' => [                                
                            (Yii::$app->request->getUrl() == Url::toRoute(['/projects/view?id='.$model->id])) ? 
                            ['label' => '<i class="fa fa-home"></i> '.$model->code, 'url' =>['/projects/view', 'id'=>$model->id]] : 
                            ['label' => '<i class="fa fa-home"></i> '.$model->code, 'items' => [
                                ['label' => '<i class="fa fa-home"></i> '.$model->code, 'url' => ['/projects/view', 'id'=>$model->id]],
                                ['label' => '<i class="fa fa-cog"></i> Podešavanje projekta', 'url' => ['/projects/update', 'id'=>$model->id], 'linkOptions'=>['style'=>'']],
                                '<li class="divider"></li>',
                                '<li class="dropdown-header">Podaci</li>',
                                ['label' => 'Investitori', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab1']],
                                ['label' => 'Dokumenti', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab2']],                                 
                                
                            ]],
                            // tehnička dokumentacija
                            /*(Yii::$app->controller->id=='project-volumes' and Yii::$app->controller->action->id=='view') ? 
                            ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])] : */
/*

                            ['label' => '<i class="fa fa-book"></i> Sveske', 'items' => $vols, 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],
                            '<li class="divider-vertical"></li>',
                            // parcela
                            ['label' => '<i class="fa fa-map-marker"></i> Lokacija', 'url' => ['/project-lot/view', 'id'=>$model->id]],
                            // objekat
                            ['label' => '<i class="fa fa-home"></i> Objekat', 'items' => [
                                //($model->work!='nova_gradnja') ? '<li class="dropdown-header">Postojeće stanje</li>' : '',
                                ($model->work!='nova_gradnja') ? ['label' => $model->projectExBuilding->name. ' (postojeće stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectExBuilding->id]] : '',                              
                                ($model->work!='nova_gradnja' and $model->work!='adaptacija') ? ['label' => 'Površine (postojeće stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectExBuilding->id, '#'=>'w10-tab1']] : '',                       

                                ($model->work!='nova_gradnja' and $model->work!='adaptacija') ? '<li class="divider"></li>' : '',
                                //($model->work!='nova_gradnja') ? '<li class="dropdown-header">Predviđeno stanje</li>' : '',
                                ($model->projectBuilding) ? ['label' => $model->projectBuilding->name. ' (predviđeno stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectBuilding->id]] : '',
                                ($model->projectBuilding) ? ['label' => 'Površine (predviđeno stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuilding->id, '#'=>'w10-tab1']] : '',
                                '<li class="divider"></li>',
                                ($model->work!='nova_gradnja') ? ['label' => '<i class="fa fa-cog"></i> Podešavanje objekta', 'url' => ['/project-building/update', 'id'=>$model->projectExBuilding->id], 'linkOptions'=>['style'=>'']] : ['label' => '<i class="fa fa-cog"></i> Podešavanje objekta', 'url' => ['/project-building/update', 'id'=>$model->projectBuilding->id], 'linkOptions'=>['style'=>'']],

                            ], 'active'=>(($model->projectExBuilding and Yii::$app->request->getUrl() == Url::toRoute(['/project-building/view?id='.$model->projectExBuilding->id])) or ($model->projectBuilding and Yii::$app->request->getUrl() == Url::toRoute(['/project-building/view?id='.$model->projectBuilding->id])))],


                            // jedinice
                            ($model->work=='adaptacija') ?
                            ['label' => '<i class="fa fa-key"></i> '.c($model->projectUnit->fullType), 'items' => [
                                
                                ['label' => c($model->projectExUnit->fullType). ' (postojeće stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectExUnit->id]],
                                
                                ['label' => c($model->projectUnit->fullType). ' (predviđeno stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectUnit->id]],
                                '<li class="divider"></li>',                      
                                ['label' => 'Podešavanje jedinice', 'url' => ['/project-building-storey-parts/update', 'id'=>$model->projectExUnit->id]],
                            ], 'active'=>(Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectUnit->id]) or Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectExUnit->id]))] : '',
                            
                            ($model->work!='promena_namene' and $model->work!='ozakonjenje') ?
                            ['label' => '<i class="fa fa-calculator"></i> Predmer', 'url' => ['/project-qs/index', 'ProjectQs[project_id]'=>$model->id], 'active'=>(Yii::$app->controller->id == 'project-qs')] : '',
                            
                        ]
                    ]);
                ?>
            </div>
        </div>

*/?>