
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
        <div class="head"><i class="fa fa-info-circle"></i> <?= ($model->project->work!='nova_gradnja' and $model->project->work!='promena_namene' and $model->project->work!='ozakonjenje') ? c($model->name) . ': ' . $model->state.' - Osnovni podaci' : 'Osnovni podaci objekta'; ?>
        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog fa-lg"></i>', Url::to(['/project-building/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-lg']) ?>
            </div>
        </div>
        <div class="subhead">Predmetni objekat projekta. Ukupna bruto površina: <?= $model->grossArea ?> m<sup>2</sup></div>
    </div>
    <div class="secondary-context ">  
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'project.name',
                'building.class',
                'state',
                'name',
                'type',
                'buildingType.name',
                'ground_floor_level',
                'building_line_dist',
                'width',    
                'length',                        
                'gross_area_part',
                [
                    'attribute'=>'gross_area',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->grossArea;
                    },
                ],
                [
                    'attribute'=>'gross_area_above',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->grossAboveArea;
                    },
                ],
                [
                    'attribute'=>'gross_area_below',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->grossBelowArea;
                    },
                ],
                [
                    'attribute'=>'net_area',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->netArea;
                    },
                ],
                [
                    'attribute'=>'net_area',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->subNetArea;
                    },
                ],
                [
                    'attribute'=>'ground_floor_area',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->pr ? $data->pr->gross_area : null;
                    },
                ],
                [
                    'attribute'=>'occupancy_area',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->pr ? $data->pr->gross_area : null;
                    },
                ],
                [
                    'attribute'=>'units_total',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->spratnost;
                    },
                ],
                'storey_height',
                [
                    'attribute'=>'units_total',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->brStanova;
                    },
                ],
                [
                    'attribute'=>'units_total',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->brPoslProstora;
                    },
                ],
                'ridge_orientation',
                'roof_pitch',
                'characteristics:ntext',
                'cost',
            ],
        ]) ?>
    </div>
</div>