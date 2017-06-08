
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="docs">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-file"></i> Dokumenti
        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi dokument', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm shadow']) ?>
            </div>
        </div>
        <div class="subhead">Lista dokumenata projekta.

        </div>
    </div>
    <div class="secondary-context">
        <?php if($projectFiles = $model->projectFiles){
            foreach($projectFiles as $projectFile){ 
                if($projectFile->type!='drugo'){
                    $thumb = ($projectFile->file and $projectFile->file->type!='pdf') ? Html::img('/images/projects/'.$projectFile->project->year.'/'.$projectFile->project_id.'/'.$projectFile->file->name, ['style'=>'max-height:30px;']) : '<i class="fa fa-file-pdf-o fa-3x gray-color"></i>'; ?>

                    <div class="header-context cont">
                        <div class="avatar">
                            <?= $thumb ?>
                        </div>
                        <div class="title" style="float:none; margin-left: 32px; ">
                            <div class="head lower"><?= Html::a($projectFile->document, Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => '']) ?></div>
                            <div class="subhead"><?= $projectFile->name ?></div>
                        </div>
                    </div>
            <?php
                }                    
            }
        } else {
            echo 'Nije unet nijedan dokument.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj dokument', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-link btn-sm shadow']);
            } ?>
    </div>            
</div>