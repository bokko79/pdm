<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
?>
<div class="card_container record-full grid-item fadeInUp no-margin animated-not" id="lot">

    <div class="primary-context">
        <div class="head">
        <?php /* <div class="subaction"><?= Html::a('<i class="fa fa-cog"></i> Uredi parcelu', Url::to(['/project-lot/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?>
            </div> */ ?>
            <i class="fa fa-info-circle"></i> Osnovni podaci predmetne parcele
        </div>
        <div class="subhead">Predmetna parcela projekta.</div>
    </div> 
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                   'attribute'=>'conditions',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return $data->conditions ? 'Da' : 'Ne';
                    },
                ], 
                'type',
                'climate',
                'seismic',
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
            'options' => ['class'=>'table table-hover']
        ]) ?>
    </div>           
</div>