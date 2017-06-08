<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\affix\Affix;

$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50);

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji projekti'), 'url' => ['/user/security/home']];
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['/projects/view', 'id' => $model->id]];
$links = [
        ['label' => Yii::t('app', 'Moji projekti'), 'url' => ['/user/security/home']],
        ['label' => $title, 'url' => ['/projects/view', 'id' => $model->id]],
    ];

if(isset($this->params['breadcrumbs'])){
    $links = array_merge($links, $this->params['breadcrumbs']);
};
?>
                


        <div class="col-sm-12">
            <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => \Yii::$app->user->can('updateOwnProject', ['project'=>$model]) ? '@'.Yii::$app->user->username : 'Početna', 'url' => \Yii::$app->user->can('updateOwnProject', ['project'=>$model]) ? '/user/security/home' : Yii::$app->getHomeUrl()],
                    
                    'links' => $links, 
                    //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
        </div>

        <div class="col-sm-12" style="z-index: 1">
           <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated-not" id="">
                <div class="primary-context normal">
                    <div class="head large">
                        <div class="subhead" style="margin-bottom:10px;">
                            <div class="label label-default fs_12 regular"><?= $model->type ?></div>
                            <div class="label label-<?= $model->status=='active' ? 'success' : 'danger' ?> fs_12 regular"><?= $model->status=='active' ? '<i class="fa fa-check"></i> aktivan' : '<i class="fa fa-times"></i> neaktivan' ?></div>
                            <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_12 regular"><?= $model->visible ? '<i class="fa fa-eye"></i> prikazan' : '<i class="fa fa-eye-slash"></i> sakriven' ?></div>
                            <div class="label label-warning fs_12 regular uppercase"><?= $model->phase ?></div>
                        </div>
                        
                        <div class="row">

                            <a href="/projects/<?= $model->id ?>" class=""><i class="fa fa-arrow-circle-left"></i></a> | 

                            <div class="dropdown" style="display:inline;">                                
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="letter-spacing: -1px;"><?= $model->code ?> <i class="fa fa-angle-down"></i></a>
                                <ul id="w3" class="dropdown-menu">                                            
                                    <li class="dropdown-header uppercase">Podešavanja</li>
                                    <li><a href="/projects/update?id=<?= $model->id ?>">Projekat</a></li>
                                    <li><a href="/project-lot/view?id=<?= $model->id ?>">Lokacija</a></li>
                                    <li><a href="/project-building/view?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>">Objekat</a></li>
                                    <li><a href="/project-qs/index?ProjectQs[project_id]=<?= $model->id ?>" tabindex="-1">Predmer</a></li>
                                    <li><a href="/project-volumes/index?ProjectVolumes[project_id]=<?= $model->id ?>">Sveske</a></li>                                            
                                </ul>
                            </div> 

                        <?php 
                            if(isset($this->params['page_title']))
                            {   
                                $icon = '';
                                switch ($this->params['page_title']) {
                                    case 'Objekat': $icon = '<i class="fa fa-home"></i>'; break;
                                    case 'Lokacija': $icon = '<i class="fa fa-map-marker"></i>'; break;
                                    case 'Predmer': $icon = '<i class="fa fa-calculator"></i>'; break;
                                    case 'Projekat': $icon = '<i class="fa fa-cogs"></i>'; break;                                        
                                    default: $icon = '<i class="fa fa-book"></i>'; break;
                                } ?>

                                &nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;
                                
                                <div class="dropdown" style="display:inline;">                                
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="letter-spacing: -1px;"><?= $icon . '&nbsp;' .$this->params['page_title'] ?>&nbsp;<i class="fa fa-angle-down"></i></a>

                                    <ul id="w3" class="dropdown-menu">

                                    <?php if($this->params['page_title']=='Objekat'): ?>
                                        <li class="dropdown-header uppercase"><?= (($model->projectBuilding) ? $model->projectBuilding->name : $model->projectExBuilding->name) ?></li>
                                        <li><a href="/project-building/view?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>">Objekat</a></li>
                                        <li><a href="/project-building/update?id=<?= $model->id ?>" tabindex="-1">Podešavanje objekta</a></li>
                                        <?= $model->projectExBuilding ? '<li><a href="/project-building-storeys/index?id='.$model->projectExBuilding->id.'" tabindex="-1">Površine postojeće stanje</a></li>' : null ?>
                                        <?= $model->projectBuilding ? '<li><a href="/project-building-storeys/index?id='.$model->projectBuilding->id.'" tabindex="-1">Površine predviđeno stanje</a></li>' : null ?>

                                    <?php elseif($this->params['page_title']=='Sveske'): ?>

                                        <li><a href="/project-volumes/create?ProjectVolumes[project_id]=<?= $model->id ?>"><i class="fa fa-plus-circle"></i> Nova sveska</a></li>
                                        <li class="divider"></li>
                                        <li><a href="/project-volumes/index?ProjectVolumes[project_id]=<?= $model->id ?>">Sve sveske</a></li>                                            
                                        <?php
                                        if($volumes = $model->projectVolumes){

                                            echo '<li class="divider"></li>';

                                            foreach($volumes as $volume){ ?>

                                                <li><a href="/project-volumes/view?id=<?= $volume->id ?>"><?= (!$volume->dataRequirement($volume->dataReqs()) ? '<i class="fa fa-warning red"></i> ' : '').($volume->number ? $volume->number. '. ' : '').c($volume->name) ?></a></li>      
                                        <?php                     
                                            }
                                        } ?>


                                    <?php elseif($this->params['page_title']=='Predmer'): ?>

                                        <li><a href="/project-qs/index?ProjectQs[project_id]=<?= $model->id ?>">Sve pozicije</a></li>
                                        <?php
                                        if($works = \common\models\QsWorks::find()->all()){

                                            echo '<li class="divider"></li>';

                                            foreach($works as $work){ ?>

                                                <li><a href="/project-qs/works?p=<?= $model->id ?>&w=<?= $work->id ?>"><?= count($work->posOfProject($model->id))>0 ? c($work->name). ' ('.count($work->posOfProject($model->id)).')' : '<span class="hint"><i>'.c($work->name).'</i></span>' ?></a></li>      
                                        <?php                     
                                            }
                                        } ?>

                                    <?php elseif($this->params['page_title']=='Lokacija'): ?>

                                        <li><a href="/project-lot/view?id=<?= $model->id ?>">Lokacija projekta</a>
                                        <li><a href="/project-lot/location?id=<?= $model->id ?>">Podešavanje adrese</a></li>
                                        <li><a href="/project-lot/update?id=<?= $model->id ?>">Podešavanje parcele</a></li>

                                    <?php elseif($this->params['page_title']=='Projekat'): ?>

                                        <li><a href="/projects/update?id=<?= $model->id ?>">Podešavanja projekta</a></li>
                                        <li><a href="/project-clients/create?ProjectClients[project_id]=<?= $model->id ?>">Novi investitor</a></li>
                                        <li><a href="/project-files/create?ProjectFiles[project_id]=<?= $model->id ?>">Novi dokument</a></li>
                                        <li><a href="/project-files/create?ProjectFiles[project_id]=<?= $model->id ?>&ProjectFiles[type]=drugo">Nova slika</a></li>

                                    <?php endif; ?>                                            
                                    </ul>
                                </div>
                        <?php
                            } ?>

                        <?php 
                            if(isset($this->params['page_title']) and isset($this->params['page_title_2']))
                            { ?>
                                &nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;
                                
                                <?php if($this->params['page_title']=='Lokacija' or $this->params['page_title']=='Predmer' or $this->params['page_title']=='Projekat' or ($this->params['page_title']=='Sveske' and $this->params['page_title_2']=='Nova sveska') or ($this->params['page_title']=='Objekat' and $this->params['page_title_2']!='Površine')): ?>

                                    <?= $this->params['page_title_2'] .   ((isset($this->params['building']) and $this->params['building']->mode=='existing') ? '<sup style="font-size:40%; font-weight:400;color:gray !important""> (post.st.)</sup>' : '<sup style="font-size:40%; font-weight:400;color:gray !important"> (predv.st.)</sup>') ?>


                                <?php elseif($this->params['page_title']=='Sveske' and $this->params['page_title_2']!='Nova sveska'): ?>
                                    <div class="dropdown" style="display:inline;">                                
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $this->params['page_title_2'] ?>&nbsp;<i class="fa fa-angle-down"></i></a>
                                        <ul id="w3" class="dropdown-menu">
                                    <?php
                                        if($volumes = $model->projectVolumes){
                                            foreach($volumes as $volume){
                                                if($volume->name== $this->params['page_title_2']){
                                                    if($volume->volume_id==1) { 
                                                        $sveska = 'glavna-sveska'; 
                                                    } elseif($volume->volume_id==17) { 
                                                        $sveska = 'izvod'; 
                                                    } elseif($volume->volume_id==19) { 
                                                        $sveska =  'ozakonjenje'; 
                                                    } else { 
                                                        $sveska = 'projekat'; 
                                                    } ?>

                                                    <li><a href="/project-volumes/update?id=<?= $volume->id ?>">Podešavanje sveske</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="/project-volume-drawings/index?ProjectVolumeDrawings[project_volume_id]=<?= $volume->id ?>"><i class="fa fa-image"></i> Crteži i tablice</a></li>
                                                    <li><a href="/site/<?= $sveska ?>?id=<?= $model->id ?>&volume=<?= $volume->id ?>" target="_blank"><i class="fa fa-print"></i> PDF sveske</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="/project-volumes/delete?id=<?= $volume->id ?>" data-method="post">Obriši svesku</a></li>
                                                <?php
                                                    break;
                                                }                           
                                            }
                                        } ?>                                        
                                        </ul>
                                    </div>
                            <?php elseif($this->params['page_title']=='Objekat' and isset($this->params['building'])): ?>
                                    <div class="dropdown" style="display:inline;">                                
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $this->params['page_title_2'] .  ($this->params['building']->mode=='existing' ? '<sup style="font-size:40%; font-weight:400;color:gray !important""> (post.st.)</sup>' : '<sup style="font-size:40%; font-weight:400;color:gray !important"> (predv.st.)</sup>') ?>&nbsp;<i class="fa fa-angle-down"></i></a>
                                        <?php if($this->params['page_title_2']=='Površine'): ?>
                                        <ul id="w3" class="dropdown-menu">
                                            <li><a href="/project-building-storeys/index?id=<?= $model->id ?>">Svi spratovi</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Spratovi</li>
                                            <?php
                                            if($storeys = $this->params['building']->projectBuildingStoreys){
                                                foreach($storeys as $storey){ 
                                                    if($parts = $storey->projectBuildingStoreyParts){                                                       
                                                        $netCheck = false;
                                                        foreach($parts as $part){                                                           
                                                            if($part->netArea==0){
                                                                $netCheck = true;
                                                            }                
                                                        } ?>

                                                        <li><a href="/project-building-storeys/view?id=<?= $storey->id ?>"><?= (($netCheck) ? '<i class="fa fa-warning red"></i> ' : null).c($storey->name).' @'.$storey->level ?></a></li>

                                                        <?php
                                                    } else { ?>
                                                        <li><a href="/project-building-storeys/view?id=<?= $storey->id ?>"><?= '<i class="fa fa-warning red"></i> '. c($storey->name).' @'.$storey->level ?></a></li>
                                                    <?php
                                                    }                   
                                                }
                                            }
                                            ?>                                         
                                        </ul>
                                    <?php endif; ?>
                                    </div>

                                <?php endif; ?>
                        <?php
                            } ?>


                        <?php 
                            if(isset($this->params['page_title']) and isset($this->params['page_title_2'])  and isset($this->params['page_title_3']))
                            { ?>
                                &nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;
                                
                                <?php if($this->params['page_title_3']!='Crteži' and $this->params['page_title_2']!='Površine'): ?>

                                    <?= $this->params['page_title_3'] ?>


                                <?php elseif($this->params['page_title_3']=='Crteži' and isset($this->params['volume']) and ($this->params['volume']->projectVolumeDrawings or $this->params['volume']->volume_id==2)): ?>
                                    <div class="dropdown" style="display:inline;">                                
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $this->params['page_title_3'] ?>&nbsp;<i class="fa fa-angle-down"></i></a>
                                        <ul id="w3" class="dropdown-menu">                               
                                            <li><a href="/project-volume-drawings/create?ProjectVolumeDrawings[project_volume_id]=<?= $this->params['volume']->id ?>"><i class="fa fa-plus-circle"></i> Novi crtež</a></li>
                                            <li class="divider"></li>
                                            <li><a href="/project-volume-drawings/index?ProjectVolumeDrawings[project_volume_id]=<?= $this->params['volume']->id ?>">Svi crteži</a></li>
                                            <li class="divider"></li>
                                            <?php if($this->params['volume']->projectVolumeDrawings): ?>
                                              <li><a href="/site/tablice?id=<?= $this->params['volume']->project_id ?>&volume=<?= $this->params['volume']->id ?>" target="_blank"><i class="fa fa-print"></i> PDF Tablice</a></li>
                                              <?php endif; ?> 
                                              <?php if($this->params['volume']->volume_id==2): ?>
                                              <li><a href="/site/povrsine?id=<?= $this->params['volume']->project_id ?>&volume=<?= $this->params['volume']->id ?>" target="_blank"><i class="fa fa-print"></i> PDF Površine</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                <?php elseif($this->params['page_title_2']=='Površine' and isset($this->params['building']) and isset($this->params['storey'])): ?>
                                    <div class="dropdown" style="display:inline;">                                
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $this->params['page_title_3'] ?>&nbsp;<i class="fa fa-angle-down"></i></a>
                                        <ul id="w3" class="dropdown-menu">                               
                                            <li><a href="/project-building-storeys/update?id=<?= $this->params['storey']->id ?>">Podešavanje sprata</a></li>
                                            <li class="divider"></li>
                                            <?php 
                                            if($parts = $this->params['storey']->projectBuildingStoreyParts){ ?>
                                                <li class="dropdown-header">Jedinice/Celine</li>
                                                <?php foreach($parts as $part){ ?>
                                                <li><a href="/project-building-storey-parts/view?id=<?= $part->id ?>"><?= (($part->netArea==0) ? '<i class="fa fa-warning red"></i> ' : null).c($part->name). ' '.$part->mark.' ('. $part->netArea.' m<sup>2</sup>)' ?></a></li>
                                            <?php
                                                }
                                                
                                            } ?>
                                        </ul>
                                    </div>

                                <?php endif; ?>
                        <?php
                            } ?>


                        <?= isset($this->params['page_title_4']) ? '<i class="fa fa-angle-double-right"></i> '.$this->params['page_title_4'] : null ?>
                        <?= isset($this->params['page_title_5']) ? '<i class="fa fa-angle-double-right"></i> '.$this->params['page_title_5'] : null ?>
                        <?= isset($this->params['page_title_6']) ? '<i class="fa fa-angle-double-right"></i> '.$this->params['page_title_6'] : null ?>

                       
                        </div>
                        

                    </div>
                    <div class="subhead"><?= $title ?></div>
                </div>
            </div> 
        </div>
        <hr style="margin:5px 0 30px;">
    

        
            <?php /*
            <div class="card_container record-full grid-item no-margin transparent no-shadow fadeInUp animated" id="">
                <div class="secondary-context normal">
                    <div class="head regular lower">
                        <div class="subhead uppercase hint" style="margin-bottom: 5px;">Opšti podaci</div>
                    </div>

                    <?php 
                    
                        echo Nav::widget([
                            'options'=>['class'=>'nav nav-pills nav-stacked left', 'style'=>'z-index:10000'],
                            'encodeLabels' => false,
                            'items' => [                                
                                ['label' => '<i class="fa fa-cog"></i> Opšti podaci', 'url' => ['/projects/update', 'id'=>$model->id], 'linkOptions'=>['style'=>'']],
                                
                                // investitori projekta
                                ['label' => '<i class="fa fa-user"></i> Investitor', 'url' => ['/project-clients/index', 'ProjectClients[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-clients/index?ProjectClients%5Bproject_id%5D='.$model->id])],

                                // tehnička dokumentacija
                                ['label' => '<i class="fa fa-file"></i> Dokumenti', 'url' => ['/project-files/index', 'ProjectFiles[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-files/index?ProjectFiles%5Bproject_id%5D='.$model->id])],

                                // tehnička dokumentacija
                                ['label' => '<i class="fa fa-image"></i> Galerija', 'url' => ['/project-files/index', 'ProjectFiles[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-files/index?ProjectFiles%5Bproject_id%5D='.$model->id])],

                                
                               // '<hr>',

                                // tehnička dokumentacija
                                ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],
                            ]
                        ]);
                     ?>


                </div>
            </div> */?>

            
         <?php
        /*
            <div class="card_container record-full grid-item no-margin transparent no-shadow fadeInUp animated" id="">
                <div class="secondary-context normal">
                    <div class="head regular lower">
                        <div class="subhead uppercase hint" style="margin-bottom: 5px;">Tekstualni podaci</div>
                    </div>
        <?php
        
             echo Nav::widget([
                'options'=>['class'=>'nav nav-pills nav-stacked left', 'style'=>'z-index:10000'],
                'encodeLabels' => false,
                'items' => [                                
                    
                    // parcela
                    ['label' => '<i class="fa fa-map-marker"></i> Lokacija', 'url' => ['/project-lot/view', 'id'=>$model->id]],                       
                 
                ]
            ]); 
         ?>
          
        
            echo Nav::widget([
                'options'=>['class'=>'nav nav-pills nav-stacked left', 'style'=>'z-index:10000'],
                'encodeLabels' => false,
                'items' => [                                
                                         // objekat
                    ['label' => '<i class="fa fa-home"></i> Objekat', 'url' => ['/project-building/update', 'id'=>$model->projectExBuilding ? $model->projectExBuilding->id : $model->projectBuilding->id], 'linkOptions'=>['style'=>'']],

                    // jedinice
                    ($model->work=='adaptacija') ?
                    ['label' => '<i class="fa fa-key"></i> '.c($model->projectUnit->fullType), 'items' => [
                        
                        ['label' => c($model->projectExUnit->fullType). ' (postojeće stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectExUnit->id]],
                        
                        ['label' => c($model->projectUnit->fullType). ' (predviđeno stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectUnit->id]],
                        '<li class="divider"></li>',                      
                        ['label' => 'Podešavanje jedinice', 'url' => ['/project-building-storey-parts/update', 'id'=>$model->projectExUnit->id]],
                    ], 'active'=>(Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectUnit->id]) or Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectExUnit->id]))] : '',
                    
                 
                ]
            ]); 
         ?>

         
                </div>

                <div class="secondary-context normal">
                    <div class="head regular lower">
                        <div class="subhead uppercase hint" style="margin-bottom: 5px;">Numerički podaci</div>
                    </div>
        <?php
        
            echo Nav::widget([
                'options'=>['class'=>'nav nav-pills nav-stacked left', 'style'=>'z-index:10000'],
                'encodeLabels' => false,
                'items' => [                                
                    
                    ($model->work!='nova_gradnja' and $model->work!='adaptacija') ? ['label' => '<i class="fa fa-table"></i> Površine<br>(postojeće stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectExBuilding->id, '#'=>'w10-tab1']] : '',
                    ($model->projectBuilding) ? ['label' => '<i class="fa fa-table"></i> Površine<br>(predviđeno stanje)', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuilding->id, '#'=>'w10-tab1']] : '',

                    ($model->work!='promena_namene' and $model->work!='ozakonjenje') ?
                    ['label' => '<i class="fa fa-calculator"></i> Predmer', 'url' => ['/project-qs/index', 'ProjectQs[project_id]'=>$model->id], 'active'=>(Yii::$app->controller->id == 'project-qs')] : '',
                    
                    // tehnička dokumentacija
                    //['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],
                ]
            ]); 

         
                </div>
            </div> */
         ?>

    <?php /* </div> */ ?>

             


            


       
