<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" style="z-index: 1">
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context normal">
                        <div class="head grand thin">
                        <div class="subhead" style="margin-bottom:10px;">
                            <div class="label label-default fs_11 thin"><?= $model->type. ($model->type=='project' ? ': '.$model->code : '') ?></div>
                            <div class="label label-<?= $model->status=='active' ? 'success' : 'danger' ?> fs_11 thin"><?= $model->status=='active' ? '<i class="fa fa-check"></i> aktivan' : '<i class="fa fa-times"></i> neaktivan' ?></div>
                            <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_11 thin"><?= $model->visible ? '<i class="fa fa-eye"></i> prikazan' : '<i class="fa fa-eye-slash"></i> sakriven' ?></div>
                        </div>
                            <b>Podešavanje projekta:</b> <?= Html::a(\yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null), Url::to(['/projects/view', 'id'=>$model->id]), ['class'=>'']) ?>
                            
                        </div>
                        <div class="subhead"><?= $model->projectTypeOfWorks ?> | faza: <?= $model->projectPhase ?></div>
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?php
                
                    echo Nav::widget([
                        'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000'],
                        'encodeLabels' => false,
                        'items' => [                                
                            ['label' => '<i class="fa fa-cog"></i> Opšti podaci', 'url' => ['/projects/update', 'id'=>$model->id], 'linkOptions'=>['style'=>'']],
                            // tehnička dokumentacija
                            ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],


                            
                            '<li class="divider-vertical"></li>',
                            // parcela
                            ['label' => '<i class="fa fa-map-marker"></i> Lokacija', 'url' => ['/project-lot/view', 'id'=>$model->id]],

                            '<li class="divider-vertical"></li>',
                            // objekat
                            ['label' => '<i class="fa fa-cog"></i> Objekat', 'url' => ['/project-building/update', 'id'=>$model->projectExBuilding ? $model->projectExBuilding->id : $model->projectBuilding->id], 'linkOptions'=>['style'=>'']],
                            /*['label' => '<i class="fa fa-home"></i> Objekat', 'items' => [
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
*/

                            // jedinice
                            ($model->work=='adaptacija') ?
                            ['label' => '<i class="fa fa-key"></i> '.c($model->projectUnit->fullType), 'items' => [
                                
                                ['label' => c($model->projectExUnit->fullType). ' (postojeće stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectExUnit->id]],
                                
                                ['label' => c($model->projectUnit->fullType). ' (predviđeno stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectUnit->id]],
                                '<li class="divider"></li>',                      
                                ['label' => 'Podešavanje jedinice', 'url' => ['/project-building-storey-parts/update', 'id'=>$model->projectExUnit->id]],
                            ], 'active'=>(Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectUnit->id]) or Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectExUnit->id]))] : '',
                            
                            ($model->work!='nova_gradnja' and $model->work!='adaptacija') ? ['label' => '<i class="fa fa-table"></i> Površine<br>(postojeće stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectExBuilding->id, '#'=>'w10-tab1']] : '',
                            ($model->projectBuilding) ? ['label' => '<i class="fa fa-table"></i> Površine<br>(predviđeno stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuilding->id, '#'=>'w10-tab1']] : '',

                            ($model->work!='promena_namene' and $model->work!='ozakonjenje') ?
                            ['label' => '<i class="fa fa-calculator"></i> Predmer', 'url' => ['/project-qs/index', 'ProjectQs[project_id]'=>$model->id], 'active'=>(Yii::$app->controller->id == 'project-qs')] : '',
                            
                        ]
                    ]);
                ?>
            </div>
        </div>

