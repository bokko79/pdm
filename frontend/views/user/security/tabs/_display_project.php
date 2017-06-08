<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$formatter = \Yii::$app->formatter;


$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
?>

<div class="card_container record-full grid-item no-margin no-shadow transparent" id="card_container">
    <a href="<?= Url::to(['/projects/update', 'id'=>$model->id]) ?>">
        <div class="media-area">                
            <div class="image">
                <?= $model->getAvatar(569,320) ?>                    
            </div>
        </div>
        <div class="primary-context aliceblue">
            <div class="subhead"><?= $model->code ?></div>
            <div class="head"><?= \yii\helpers\StringHelper::truncate($model->name, 80) ?></div>
            <div class="subhead"><?= $model->projectBuilding ? $model->projectBuilding->name : $model->projectExBuilding->name ?></div>
        </div>
        <hr style="margin:0">
        <?php // sveske ?>    
        <div class="secondary-context">
            <div class="head thin lower">
                <div class="subhead uppercase hint">Sveske projekta
                    <div class="subaction">
                        <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                        <?= Html::a('<i class="fa fa-sliders fa-lg"></i>', Url::to(['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
                        <?php endif; ?>
                    </div>                    
                </div>
            </div> 
        </div>
                    <?php if($projectVolumes = $model->projectVolumes){
                        foreach($projectVolumes as $projectVolume)
                        { 
                            if($projectVolume->volume_id==1) { 
                                $sveska = 'glavna-sveska'; 
                              } elseif($projectVolume->volume_id==17) { 
                                $sveska = 'izvod'; 
                              } elseif($projectVolume->volume_id==19) { 
                                $sveska =  'ozakonjenje'; 
                              } else { 
                                $sveska = 'projekat'; 
                              }  ?>
                            <div class="header-context cont">
                                <div class="avatar ">
                                    <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
                                </div>
                                <div class="subaction">
                                    <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                                    <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$projectVolume->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
                                    <?php else: ?>
                                    <?= Html::a('<i class="fa fa-download  fa-2x"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="title" style="float:none; margin-left: 32px; ">
                                    <div class="head second regular"><?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($projectVolume->number.'. '.$projectVolume->name, Url::to(['/project-volumes/view', 'id'=>$projectVolume->id]), ['class' => '']) : $projectVolume->number.'. '.$projectVolume->name ?></div>
                                    <div class="subhead"><?= $projectVolume->engineer->name ?></div> 
                                </div>
                            </div>
                    <?php
                        }
                    } ?>  
            </div>           
                

            <?php // sveske ?>    
                <div class="secondary-context">
                    <div class="head thin second">
                        <div class="subhead uppercase hint">Predmer i predračun radova
                            <div class="subaction">
                                <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                                <?= Html::a('<i class="fa fa-sliders fa-lg"></i>', Url::to(['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                                <?php endif; ?>
                            </div>                    
                        </div>
                    </div>
                </div> 
                <?php if($model->projectQs){ ?>
                        <div class="header-context cont">
                            <div class="avatar">
                                <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
                            </div>
                            <div class="subaction">
                                <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                                <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/predmer', 'id'=>$model->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
                                <?php else: ?>
                                    <?= Html::a('<i class="fa fa-download fa-2x"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
                                    <?php endif; ?>
                            </div>
                            <div class="title" style="float:none; margin-left: 32px; ">
                                <div class="head second regular"><?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a('Predmer radova projekta', Url::to(['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]), ['class' => '']) : 'Predmer radova projekta' ?></div>
                                <div class="subhead"><?= $formatter->format($model->getProjectTotalPrice(), ['decimal',2]) ?></div>
                            </div>
                        </div>
                    
                <?php } ?>          
                


            <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>

                <div class="secondary-context">
                    <div class="head thin second">
                        <div class="subhead uppercase hint">Dokumenti projekta             
                            <div class="subaction">
                                <?= Html::a('<i class="fa fa-plus fa-lg"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                            </div>
                        </div> 
                    </div>
                </div>

                <?php if($projectFiles = $model->projectFiles){
                    foreach($projectFiles as $projectFile)
                    {
                        if($projectFile->type!='drugo')
                        { ?>
                            <div class="header-context cont">
                                <div class="avatar ">
                                    <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
                                </div>
                                <div class="subaction">
                                    <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/download', 'path'=>'/images/projects/'.$model->year.'/'.$model->id.'/'.$projectFile->file->name], ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
                                </div>
                                <div class="title" style="float:none; margin-left: 32px; ">
                                    <div class="head second regular"><?= Html::a(\yii\helpers\StringHelper::truncate($projectFile->name, 32), Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => '']) ?></div>
                                    <div class="subhead"><?= $projectFile->document ?></div> 
                                </div>
                            </div>
                    <?php
                        }       
                
                    }               
                    
                } else {
                    echo '<div class="secondary-context cont">Ovaj projekat nema prikačenih dokumenata.</div>';
                } ?>
                     
            
            <?php endif; ?>

        <?php // Client ?>          
        <div class="secondary-context cont">
            <div class="head lower regular">
                <div class="subhead uppercase hint" style="margin-bottom: 5px;">
                <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                    <div class="subaction">
                        <?= Html::a('<i class="fa fa-plus fa-lg"></i>', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                    </div>
                <?php endif; ?>
                Investitor/i
                </div>
                <?php if($projectClients = $model->projectClients){
                    foreach($projectClients as $projectClient)
                    {
                        $client = $projectClient->client;
                        echo '<div style="padding-top:5px;">'.((\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => '', 'style'=>'color:;']) : $client->name) . ', <small class="hint" style="font-size:70%">'.$client->location->city->town. '</small></div>';
                    }
                } ?>

            </div>              
        </div>

        <?php // lokacija ?>                
        <div class="secondary-context">
            <div class="head second regular">
                <div class="subhead uppercase hint" style="margin-bottom: 5px;">Lokacija i parcela

                <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                    <div class="subaction">
                        <?= Html::a('<i class="fa fa-sliders fa-lg"></i>', Url::to(['/project-lot/location', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                    </div>
                <?php endif; ?>
                </div>

                <?= $model->location->getLotAddress(true) ?>
            </div>
        </div>




    <?php // Objekat postojeće stanje ?>
    <?php if($ExBuilding = $model->projectExBuilding): ?>
        <div class="secondary-context gray">
            <div class="head">
                <div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat - postojeće stanje
                    <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                    <div class="subaction">
                        <?= Html::a('<i class="fa fa-sliders fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$ExBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                    </div>  
                    <?php endif; ?>
                </div>                  
                <?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($ExBuilding->name. ' ' .$ExBuilding->storey, Url::to(['/project-building/view', 'id'=>$ExBuilding->id]), ['class' => '']) : $ExBuilding->name. ' ' .$ExBuilding->storey ?>
                <p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $ExBuilding->type ?></p>
            </div>              
        </div>               

        <hr style="margin:0">
    <?php endif; ?>

    <?php // Objekat postojeće stanje ?>
    <?php if($NewBuilding = $model->projectBuilding): ?>
        <div class="secondary-context gray">
            <div class="head">
                <div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat - predviđeno stanje
                    <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
                    <div class="subaction">
                        <?= Html::a('<i class="fa fa-sliders fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$NewBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
                    </div>  
                    <?php endif; ?>
                </div>                  
                <?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($NewBuilding->name. ' ' .$NewBuilding->storey, Url::to(['/project-building/view', 'id'=>$NewBuilding->id]), ['class' => '']) : $NewBuilding->name. ' ' .$NewBuilding->storey ?>
                <p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $NewBuilding->type ?></p>
            </div>              
        </div>

        <hr style="margin:0">                
    <?php endif; ?>             

            
    </a>
</div>