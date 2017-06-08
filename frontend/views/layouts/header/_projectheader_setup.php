<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$title = ($model->code ?: sprintf('%04d', $model->id)). ': '.\yii\helpers\StringHelper::truncate($model->name, 50);
?>            
 
<ul class="sidebar setup collapse" id="navbar-collapse">
    <li class="dashboard <?= $this->params['page_title']=='Summary' ? 'active' : null ?>">
        <table>
            <tr>
                <td class="main-switch-menu"><i class="fa fa-file-o fa-2x"></i><div style="font-size:9px;"><?= $model->type=='presentation' ? 'Prezentacija projekta' : 'Projekat' ?></div></td>
                <td class="side-menu">
                    <?php if($model->setup_status==''): ?>
                    <div class="secondary-context gray" style="">                
                        <div class="image">
                            <?= $model->getAvatar(260,195) ?>                    
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="secondary-context gray no-margin hidden-md bottom-bordered">
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
                </td>
            </tr>
        </table>
    </li>
    <li class="active">
        <table>
            <tr>
                <td class="main-switch-menu"><i class="fa fa-file fa-2x"></i><div style="font-size:9px;">Opšte</div></td>
                <td class="side-menu">
                    <div class="">
                        <ul class="StepProgress">

                            <li class="<?= $model->setupStep==1 ? 'active' : null ?> StepProgress-item <?= $model->getSetupCheck(1) ?>"><a href="/projects/update?id=<?= $model->id ?>">Opšti podaci</a></li>
                            <li class="<?= (Yii::$app->controller->id=='project-clients') ? 'active' : null ?> StepProgress-item <?= $model->getSetupCheck(2) ?>"><?= $model->getSetupCheck(2)!=null ? '<a href="/project-clients/create?ProjectClients[project_id]='.$model->id.'">Investitori</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Investitori</i></span>' ?></li>                                
                            <?php if($model->type=='project'): ?>
                                <li class="<?= (Yii::$app->controller->id=='project-files') ? 'active' : null ?> StepProgress-item <?= $model->getSetupCheck(3) ?>"><?= $model->getSetupCheck(3)!=null ? '<a href="/project-files/create?ProjectFiles[project_id]='.$model->id.'">Dokumenti</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Dokumenti</i></span>' ?></li>
                            <?php endif; ?>
                            <li class="<?= (Yii::$app->controller->id=='project-images') ? 'active' : null ?> StepProgress-item <?= $model->getSetupCheck(4) ?>"><?= $model->getSetupCheck(4)!=null ? '<a href="/project-images/create?ProjectImages[project_id]='.$model->id.'">Galerija</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Galerija</i></span>' ?></li>
                            <li class="<?= (Yii::$app->controller->id=='project-volumes') ? 'active' : null ?> StepProgress-item <?= $model->getSetupCheck(5) ?>"><?= $model->getSetupCheck(5)!=null ? '<a href="/project-volumes/index?ProjectVolumesSearch[project_id]='.$model->id.'">Sveske</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Sveske</i></span>' ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </li>        

    <li class="<?= $model->setupStep>5 ? 'active' : null ?>">
        
        <table>
            <tr>
                <td class="main-switch-menu"><i class="fa fa-map-marker fa-2x"></i><div style="font-size:9px;">Lokacija</div></td>
                <td class="side-menu"> 
                    <div class="">
                        <ul class="StepProgress">
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <li class="<?= (Yii::$app->controller->id=='project-lot' and Yii::$app->controller->action->id=='location') ? 'active' : '' ?> StepProgress-item <?= $model->getSetupCheck(6) ?>"><?= $model->getSetupCheck(6)!=null ? '<a href="/project-lot/location?id='.$model->id.'">Adresa</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Adresa</i></span>' ?></li>
                            <?php if($model->type=='project'): ?>
                            <li class="<?= (Yii::$app->controller->id=='project-lot' and Yii::$app->controller->action->id=='update') ? 'active' : '' ?> StepProgress-item <?= $model->getSetupCheck(7) ?>"><?= $model->getSetupCheck(7)!=null ? '<a href="/project-lot/update?id='.$model->id.'">Parcela</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Parcela</i></span>' ?></li>
                            <li class="<?= (Yii::$app->controller->id=='location-lots') ? 'active' : '' ?> StepProgress-item <?= $model->getSetupCheck(8) ?>"><?= $model->getSetupCheck(8)!=null ? '<a href="/location-lots/index?LocationLots[project_id]='.$model->id.'">Katastartske parcele</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Katastartske parcele</i></span>' ?></li>
                            <li class="<?= (Yii::$app->controller->id=='project-lot-existing-buildings') ? 'active' : '' ?> StepProgress-item <?= $model->getSetupCheck(9) ?>"><?= $model->getSetupCheck(9)!=null ? '<a href="/project-lot-existing-buildings/index?id='.$model->id.'">Postojeći objekti</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Postojeći objekti</i></span>' ?></li>
                            <li class="<?= (Yii::$app->controller->id=='project-lot-future-developments') ? 'active' : '' ?> StepProgress-item <?= $model->getSetupCheck(10) ?>"><?= $model->getSetupCheck(10)!=null ? '<a href="/project-lot-future-developments/index?id='.$model->id.'">Predviđeni objekti</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Predviđeni objekti</i></span>' ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </li>
    <li class="<?= $this->params['page_title']=='Objekat' ? 'active' : null ?>">            
        <table>
            <tr>
                <td class="main-switch-menu"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Objekat</div></td>
                <td class="side-menu">
                    
                    <?php $building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding; ?>
                    <div class="">
                        <ul class="StepProgress">
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <?= ($model->type=='project') ? '<li class="StepProgress-item" style="visibility: hidden; position: absolute;"></li>' : null ?>
                            <li class="StepProgress-item <?= $model->getSetupCheck(11) ?>"><?= $model->getSetupCheck(11)!=null ? '<a href="/project-building/update?id='.(($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id).'">Objekat</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Objekat</i></span>' ?></li>
                            <?php if($model->type=='project'): ?>
                                <?php if($model->projectExBuilding): ?>
                            <li class="StepProgress-item <?= $model->getSetupCheck(13) ?>"><?= $model->getSetupCheck(13)!=null ? '<a href="/project-building/storeys?id='.$model->projectExBuilding->id.'">Spratnost (postojeće)</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Spratnost (postojeće)</i></span>' ?></li>
                                <?php endif; ?>
                                <?php if($model->projectBuilding): ?>
                            <li class="StepProgress-item <?= $model->getSetupCheck(19) ?>"><?= $model->getSetupCheck(19)!=null ? '<a href="/project-building/storeys?id='.$model->projectBuilding->id.'">Spratnost (predviđeno)</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Spratnost (predviđeno)</i></span>' ?></li>
                                <?php endif; ?>
                            <?php /* $model->projectExBuilding ? '<li class="StepProgress-item '.$model->getSetupCheck(20).'"><a href="/project-building-storeys/index?id='.$model->projectExBuilding->id.'">Površine postojeće stanje</a></li>' : null ?>
                            <?= $model->projectBuilding ? '<li class="StepProgress-item '.$model->getSetupCheck(23).'"><a href="/project-building-storeys/index?id='.$model->projectBuilding->id.'">Površine predviđeno stanje</a></li>' : null */ ?>
                            <li class="StepProgress-item <?= $model->getSetupCheck(24) ?>"><?= $model->getSetupCheck(24)!=null ? '<a href="/project-building-classes/index?ProjectBuildingClasses[project_building_id]='.(($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id).'">Klase objekta</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Klase objekta</i></span>' ?></li>
                            <li class="StepProgress-item <?= $model->getSetupCheck(25) ?>"><?= $model->getSetupCheck(25)!=null ? '<a href="/project-building-heights/index?ProjectBuildingHeights[project_building_id]='.(($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id).'">Visine delova objekta</a>' : '<span class="bold uppercase fs_10 hint" style="color:#bbb;"><i>Visine delova objekta</i></span>' ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>


                </td>
            </tr>
        </table>
    </li>        
</ul>