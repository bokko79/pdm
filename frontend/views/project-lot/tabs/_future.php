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
        <div class="head">Predviđeni objekti na parceli <i class="fa this-one fa-arrow-circle-right"></i>
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj predviđeni objekat', Url::to(['/project-lot-future-developments/create', 'ProjectLotFutureDevelopments[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista postojećih objekata na predmetnoj parceli.
        </div>
    </div>
    <div class="secondary-context">
        <?php if($developments = $model->project->projectLotFutureDevelopments);
        foreach($developments as $development){
            echo Html::a(c($development->buildingType->name.' '.$development->name), Url::to(['/project-lot-future-developments/update', 'id'=>$development->id]), ['class' => 'btn btn-default', 'style'=>'']).'<br>';
        } ?>
    </div>
</div>