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
        <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci predmetne parcele <i class="fa this-one fa-arrow-circle-right"></i>
        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi parcelu', Url::to(['/project-lot/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
        <div class="subhead">Predmetna parcela projekta.</div>
    </div>
    <div class="secondary-context">   
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'project.name',
                [
                   'attribute'=>'conditions',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return $data->conditions ? 'Da' : 'Ne';
                    },
                ], 
                'type',
                'area',
                'width',
                'length',
                'ground',
                'ground_level',
                'road_level',
                'underwater_level', 
                'green_area_reg',
                'green_area',
                'occupancy_reg',
                'built_index_reg',
                'parking_spaces',
                'parking_disabled',
                'description:ntext',
                'disposition:ntext',
                'access:ntext',
                'parking:ntext',                
                'adjacent_border:ntext',   
                'services:ntext',
                'legal:ntext',
                'ownership:ntext',
                'note:ntext',
                
                
            ],
        ]) ?>
    </div>           
</div>