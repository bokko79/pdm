
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="gallery">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-image"></i> Galerija
        <div class="subaction"><?= Html::a('<i class="fa fa-plus-circle"></i> Nova slika', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id, 'ProjectFiles[type]'=>'drugo']), ['class' => 'btn btn-primary btn-sm shadow']) ?>
            </div>
        </div>
        <div class="subhead">Galerija slika projekta.

        </div>
    </div>
    <div class="secondary-context">
        <?php if($projectFiles = $model->projectFiles){
            foreach($projectFiles as $projectFile){ 
                if($projectFile->type=='drugo'){
                    echo Html::img('/images/projects/'.$projectFile->project->year.'/'.$projectFile->project_id.'/'.$projectFile->file->name, ['style'=>'max-height:120px;']); 
                    echo Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => 'btn btn-success btn-sm shadow']);
                }                
            }
        } else {
            echo 'Nije uneta nijedna slika.' . Html::a('<i class="fa fa-plus-circle"></i> Dodaj slike', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id, 'ProjectFiles[type]'=>'drugo']), ['class' => 'btn btn-link btn-sm shadow']);
            } ?>
    </div>            
</div>