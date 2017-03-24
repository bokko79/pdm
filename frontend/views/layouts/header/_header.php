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
            <div class="col-sm-12">
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context normal">
                        <div class="head grand thin"><i class="fa fa-file-powerpoint-o"></i> <?= \yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null) ?>
                            <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-bell-o"></i> Podsetnik'), Url::to(), ['class'=>'btn btn-default shadow', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#todolist']) ?>
                            </div>
                        </div>
                        <div class="subhead">Podaci projekta.</div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <?php
                $vols = [];
                    $vols[] = ['label' => '<i class="fa fa-book"></i> Index Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]];
                    $vols[] = ['label' => '<i class="fa fa-plus-circle"></i> Nova sveska', 'url' => ['/project-volumes/create', 'ProjectVolumes[project_id]'=>$model->id]];
                    $vols[] = '<li class="divider"></li>';
                    foreach($model->projectVolumes as $volume){
                        $vols[] = ['label' => $volume->number. '. '. c($volume->name), 'url' =>['/project-volumes/view', 'id'=>$volume->id]];   
                    }
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
                            ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])] : */['label' => '<i class="fa fa-book"></i> Sveske', 'items' => $vols, 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],
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

