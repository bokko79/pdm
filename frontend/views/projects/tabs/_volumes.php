<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Projektna dokumentacija
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi deo', Url::to(['/project-volumes/create', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm shadow']) ?></div>
        </div>
        <div class="subhead"><p>Za izabrani projekat, vrstu radova, fazu projetka i klasu objekta, <b class="red">obavezni</b> su sledeći delovi projektne dokumentacije:</p>
        </div>
    </div>
    <div class="secondary-context">
        <ul class="">
            <?php if($volumes = $model->projectVolumes);
        foreach($volumes as $volume){
            /*echo Html::a(c($volume->name), Url::to(['/site/glavna-sveska', 'id'=>$model->id]), ['class' => 'btn btn-danger', 'style'=>'width:100%', 'target'=>'_blank']).'<br>';*/
            echo '<li style="margin:10px 0">'.Html::a($volume->number.'. '.c($volume->name), Url::to(['/project-volumes/view', 'id'=>$volume->id]), ['class' => 'btn btn-default shadow', 'style'=>'width:100%', ]).'</li>';
        } ?>
        </ul>
        
    </div>            
</div>