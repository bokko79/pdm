<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

if($model->volume_id==1) { 
    $sveska = 'glavna-sveska'; 
} elseif($model->volume_id==17) { 
    $sveska = 'izvod'; 
} elseif($model->volume_id==19) { 
    $sveska =  'ozakonjenje'; 
} else { 
    $sveska = 'projekat'; 
}

?>
<a href="<?= Url::to(['/project-volumes/view?id='.$model->id]) ?>">
<div class="card_container record-full transparent list-item no-border" id="card_container" style="float:none;">
    
        <div class="header-context">
            <div class="avatar ">
                <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
            </div>
            <div class="subaction">
                <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/'.$sveska, 'id'=>$model->project->id, 'volume'=>$model->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
            </div>
            <div class="title" style="float:none; margin-left: 32px; ">
                <div class="head second regular"><?= Html::a($model->number.'. '.$model->name, Url::to(['/project-volumes/view', 'id'=>$model->id]), ['class' => '']) ?></div>
                <div class="subhead"><?= $model->code ?> | <?= $model->practice->name ?> | <?= $model->engineer->name ?></div> 
            </div>
        </div>
    
</div></a>