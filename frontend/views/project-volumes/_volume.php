
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

<li>
    <a href="/project-volumes/view?id=<?= $model->id ?>">
        <div class="secondary-context normal no-padding">
            <div class="head lower">
                <div class="subaction">
                    <?php // Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/'.$sveska, 'id'=>$model->project->id, 'volume'=>$model->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
                    <?= Html::a('<i class="fa fa-cogs fa-2x"></i>', Url::to(['/project-volumes/update?id='.$model->id]), ['class' => '']) ?>
                </div>
                <?= Html::a($model->number.'. '.$model->name, Url::to(['/project-volumes/view?id='.$model->id]), ['class' => '']) ?>
            </div>
            <div class="subhead"><?= $model->code ?> | <?= $model->practice->name ?> | <?= $model->engineer->name ?></div>
        </div>    
    </a>
</li>
        