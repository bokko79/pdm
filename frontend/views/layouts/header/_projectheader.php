<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50);
?>            
 


    <ul class="sidebar setup collapse" id="navbar-collapse">
        <li class="dashboard <?= $this->params['page_title']=='Summary' ? 'active' : null ?>">
            <table>
                <tr>
                    <td class="main-switch-menu"><i class="fa fa-file-o fa-2x"></i></td>
                    <td class="side-menu">
                        <?php if($model->setup_status==''): ?>
                        <div class="secondary-context gray hidden-md " style="">                
                            <div class="image">
                                <?= $model->getAvatar(260,195) ?>                    
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="secondary-context gray no-margin <?= ($model->setup_status=='') ? 'cont' : '' ?>">
                            <div class="head major">
                                <div class="subhead" style="margin-bottom:10px;">
                                    <div class="label label-<?= $model->status=='active' ? 'success' : 'danger' ?> fs_9 regular"><?= $model->status=='active' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></div>
                                    <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_9 regular"><?= $model->visible ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>' ?></div>
                                    <div class="label label-info fs_9 uppercase"><?= $model->phase ?></div>
                                    <div class="label label-info fs_9 uppercase"><?= $model->setup_status ?></div>
                                    <div class="label label-info fs_9 uppercase"><?= $model->setupStep ?></div>
                                </div>                                   

                                <a href="/projects/summary/<?= $model->id ?>" class="uppercase"><?= $title ?></a>
                                <div class="subhead">
                                    <?= $model->client->name ?>                    
                                </div>
                            </div>                            
                        </div>
                        <?php if($model->setup_status==''): ?>
                        <div class="action-area gray hidden-md right">
                             <?= Html::a(Yii::t('app', '<i class="fa fa-image"></i> Prezentacija projekta'), ['/projects/view', 'id'=>$model->id], ['class' => 'btn btn-default']) ?>                         
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </li>
        <li class="<?= $this->params['page_title']=='Projekat' ? 'active' : null ?>">
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/projects/update?id=<?= $model->id ?>"><i class="fa fa-file fa-2x"></i><div style="font-size:9px;">Opšte</div></a></td>
                    <td class="side-menu">
                        <?php if($model->setup_status==''): ?>
                        <div class="primary-context normal">
                            <div class="head second">
                            
                                <a href="/projects/summary?id=<?= $model->id ?>"><i class="fa fa-file"></i> Građevinski projekat</a>
                            </div>
                            <div class="subhead">Opšta podešavanja tehničkog projekta.</div>
                        </div>
                        <?php endif; ?>
                        <?php if($this->params['page_title']=='Projekat' or $model->setup_status!=''): ?>

                            <ul class="nav nav-pills nav-stacked left">
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/projects/update?id=<?= $model->id ?>">Podešavanje</a></td></tr></table></li>                                   
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-clients/create?ProjectClients[project_id]=<?= $model->id ?>">Investitori</a></td></tr></table></li>                                    
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-files/create?ProjectFiles[project_id]=<?= $model->id ?>">Dokumenti</a></td></tr></table></li>
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-images/create?ProjectImages[project_id]=<?= $model->id ?>">Galerija</a></td></tr></table></li>
                                <li class="<?= (Yii::$app->controller->id=='project-volumes') ? 'active' : null ?>"><table><tr><td><i class="fa fa-book"></i></td><td><a href="/project-volumes/index?ProjectVolumesSearch[project_id]=<?= $model->id ?>">Sveske</a></td></tr></table></li>
                            </ul>

                        <?php endif; ?>

                    </td>
                </tr>
            </table>
        </li>
        <?php /*
        <li class="<?= $this->params['page_title']=='Sveske' ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/project-volumes/index?ProjectVolumes[project_id]=<?= $model->id ?>"><i class="fa fa-book fa-2x"></i><div style="font-size:9px;">Sveske</div></a></td>
                    <td class="side-menu">
                        
                            <div class="primary-context normal hidden-md">
                                <div class="head second">
                                
                                    <a href="/project-volumes/index?ProjectVolumes[project_id]=<?= $model->id ?>"><i class="fa fa-book"></i> Tehnička dokumentacija projekta</a>
                                </div>
                                <div class="subhead">Spisak tehničke dokumentacije za dati projekat, fazu projekta, vrstu radova, vrstu i klasu objekta.</div>
                            </div>
                        <?php if($this->params['page_title']=='Sveske' or $model->setup_status!=''): ?>    
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav nav-pills nav-stacked left">
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
                                </ul>
                            </div>


                        <?php endif; ?>

                    </td>
                </tr>
            </table>
        </li> */ ?>

        <li class="<?= $this->params['page_title']=='Lokacija' ? 'active' : null ?>">
            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/project-lot/view?id=<?= $model->id ?>"><i class="fa fa-map-marker fa-2x"></i><div style="font-size:9px;">Lokacija</div></a></td>
                    <td class="side-menu">                      
                        <?php if($model->setup_status==''): ?>
                        <div class="primary-context normal">
                            <div class="head second">
                            
                                <a href="/project-lot/view?id=<?= $model->id ?>" class=""><i class="fa fa-map-marker"></i> Lokacija projekta</a>
                            </div>
                            <div class="subhead"><?= $model->location->getLotAddress(true) ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if($this->params['page_title']=='Lokacija' or $model->setup_status!=''): ?>
                            <ul class="nav nav-pills nav-stacked left">
                                <li class="<?= (Yii::$app->controller->id=='project-lot' and Yii::$app->controller->action->id=='location') ? 'active' : '' ?>"><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-lot/location?id=<?= $model->id ?>">Podešavanje adrese</a></td></tr></table></li>
                                <li class="<?= (Yii::$app->controller->id=='project-lot' and Yii::$app->controller->action->id=='update') ? 'active' : '' ?>"><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-lot/update?id=<?= $model->id ?>">Podešavanje parcele</a></td></tr></table></li>
                                <li class="<?= (Yii::$app->controller->id=='location-lots') ? 'active' : '' ?>"><table><tr><td><i class="fa fa-check"></i></td><td><a href="/location-lots/index?LocationLots[project_id]=<?= $model->id ?>">Katastartske parcele</a></td></tr></table></li>
                                <li class="<?= (Yii::$app->controller->id=='project-lot-existing-buildings') ? 'active' : '' ?>"><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-lot-existing-buildings/index?id=<?= $model->id ?>">Postojeći objekti</a></td></tr></table></li>
                                <li class="<?= (Yii::$app->controller->id=='project-lot-future-developments') ? 'active' : '' ?>"><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-lot-future-developments/index?id=<?= $model->id ?>">Predviđeni objekti</a></td></tr></table></li>
                            </ul>
                        <?php endif; ?>

                    </td>
                </tr>
            </table>
        </li>
        <li class="<?= $this->params['page_title']=='Objekat' ? 'active' : null ?>">            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/project-building/view?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Objekat</div></a></td>
                    <td class="side-menu">
                        
                        <?php $building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding; ?>
                        <?php if($model->setup_status==''): ?>
                        <div class="primary-context normal">
                            <div class="head second">
                            
                                <a href="/project-building/view?id=<?= $building->id ?>"><i class="fa fa-home"></i> <?= $building->name ?></a>
                            </div>
                            <div class="subhead"><?= $building->building->class ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if($this->params['page_title']=='Objekat' or $model->setup_status!=''): ?>    

                            <ul class="nav nav-pills nav-stacked left">
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building/update?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>" tabindex="-1">Podešavanje objekta</a></td></tr></table></li>
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building-classes/index?ProjectBuildingClasses[project_building_id]=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>">Klase</a></td></tr></table></li>
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building-heights/index?ProjectBuildingHeights[project_building_id]=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>">Visine</a></td></tr></table></li>
                                <li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building/storeys?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>" tabindex="-1">Spratnost</a></td></tr></table></li>
                                <?= $model->projectExBuilding ? '<li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building-storeys/index?id='.$model->projectExBuilding->id.'">Površine postojeće stanje</a></td></tr></table></li>' : null ?>
                                <?= $model->projectBuilding ? '<li><table><tr><td><i class="fa fa-check"></i></td><td><a href="/project-building-storeys/index?id='.$model->projectBuilding->id.'">Površine predviđeno stanje</a></td></tr></table></li>' : null ?>
                            </ul>

                        <?php endif; ?>

                    </td>
                </tr>
            </table>
        </li>
        <?php /* if($model->work=='adaptacija'): ?>
        <li class="<?= $this->params['page_title']=='Jedinica' ? 'active' : null ?>"><i class="fa fa-bed fa-2x"></i><div style="font-size:9px;">Jedinica</div></a></li>
        <?php endif; */ ?>
        <?php if($model->setup_status==''): ?>
        <li class="<?= $this->params['page_title']=='Predmer' ? 'active' : null ?>">
            
            <table>
                <tr>
                    <td class="main-switch-menu"><a href="/project-qs/index?ProjectQs[project_id]=<?= $model->id ?>"><i class="fa fa-calculator fa-2x"></i><div style="font-size:9px;">Predmer</div></a></td>
                    <td class="side-menu">
                        
                            <div class="primary-context normal">
                                <div class="head second">
                                
                                    <a href="/project-qs/index?ProjectQs[project_id]=<?= $model->id ?>"><i class="fa fa-calculator"></i> Predmer i predračun radova</a>
                                </div>
                                <div class="subhead">Spisak radova i pozicija projekta sa količinama i okvirnim cenama po kategorijama građevinskih radova.</div>
                            </div>
                        <?php if($this->params['page_title']=='Predmer'): ?>

                                <ul class="nav nav-pills nav-stacked left">
                                    <?php
                                    if($works = \common\models\QsWorks::find()->all()){                      

                                        foreach($works as $work){ ?>

                                            <li><a href="/project-qs/works?p=<?= $model->id ?>&w=<?= $work->id ?>"><?= count($work->posOfProject($model->id))>0 ? c($work->name). ' ('.count($work->posOfProject($model->id)).')' : '<span class="hint"><i>'.c($work->name).'</i></span>' ?></a></li>      
                                    <?php                     
                                        }
                                    } ?>
                                </ul>          


                        <?php endif; ?>

                    </td>
                </tr>
            </table>
        </li>
    <?php endif; ?>
    </ul>
              
