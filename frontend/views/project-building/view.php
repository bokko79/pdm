<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = $model->project->name . ' ('. $model->spratnost . ')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projects/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-view">

    <h1><?= Html::a('<i class="fa fa-home"></i>'.Html::encode($this->title), Url::to(['/projects/view', 'id'=>$model->project_id]), ['class' => '']) ?></h1>


<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci objekta
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi objekat', Url::to(['/project-building/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Predmetni objekat projekta. Ukupna bruto površina: <?= $model->grossArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context">  
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'project.name',
                            'building.class',
                            'name',
                            'type',
                            'buildingType.name',
                            'ground_floor_level',
                            'building_line_dist',                    
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
                                    return $data->pr->gross_area;
                                },
                            ],
                            [
                                'attribute'=>'occupancy_area',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return $data->pr->gross_area;
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
        </div>
        <div class="col-sm-7">
            <?= $model->file ? Html::img('/images/projects/'.date('Y').'/'.$model->project_id.'/'.$model->file->name, ['style'=>'max-height:100%;']) : null ?>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Etaže objekta
                        <div class="action-area normal-case"><?= Html::a('Upravljanje etažama', Url::to(['/project-building/storeys', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Ukupna bruto površina objekta: <?= $model->grossArea ?> m<sup>2</sup>. Ukupna neto površina objekta: <?= $model->netArea ?> m<sup>2</sup>. Ukupna redukovana neto površina objekta: <?= $model->subNetArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingStoreys,
                        'columns' => [
                            [
                                'label'=>'Etaža',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->storey, ['project-building-storeys/view', 'id' => $data->id]);
                                },
                            ],
                            'level',
                            'gross_area',
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div> 
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Klase objekta                        
                        <div class="action-area normal-case"><?= Html::a('Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingClasses,
                        'columns' => [                            
                            [
                                'label'=>'Klasa',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->building->class, ['project-building-classes/update', 'id' => $data->id]);
                                },
                            ],
                            'percent',
                            'area',
                        ],
                        'summary' => false,
                    ]); ?>
                    <?= ($model->getClassPercentageTotal()!=100) ? '<p class="red">Zbir procenata svih delova objekta mora biti jednak 100!. Trenutno je '.$model->getClassPercentageTotal().'</p>' : null ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Visine objekta
                        <div class="action-area normal-case"><?= Html::a('Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingHeights,
                        'columns' => [
                            'part',
                            [
                                'attribute'=>'level',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->level, ['project-building-heights/update', 'id' => $data->id]);
                                },
                            ],
                            'name',
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Delovi i celine objekta
                        <div class="action-area normal-case"><?= Html::a('Dodaj deo objekta', Url::to(['/project-building-parts/create', 'ProjectBuildingParts[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingParts,
                        'columns' => [
                            
                            [
                                'attribute'=>'name',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->name, ['project-building-parts/update', 'id' => $data->id]);
                                },
                            ],
                            'gross_area',
                            'net_area',
                            'storeys',
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div>

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Stolarija i bravarija objekta
                        <div class="action-area normal-case"><?= Html::a('Dodaj poziciju', Url::to(['/project-building-doorwin/create', 'ProjectBuildingDoorwin[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingDoorwin,
                        'columns' => [
                            'pos_type',
                            [
                                'attribute'=>'type',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->type, ['project-building-doorwin/update', 'id' => $data->id]);
                                },
                            ],
                            'pos_no',                            
                            'width',
                            'height',
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Arhitektonske karakteristike objekta
                        <div class="action-area normal-case"><?= Html::a('Uredi karakteristike objekta', Url::to(['/project-building-characteristics/update', 'id'=>$model->project_id]), ['class' => 'btn btn-info btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista arhitektonskih karakteristika predmetnog objekta.</div>
                </div>
                <div class="secondary-context">
                    <?= DetailView::widget([
                        'model' => $model->project->projectBuildingCharacteristics,
                        'attributes' => [
                            'function:ntext',
                            'access:ntext',
                            'entrance:ntext',
                            'position:ntext',
                            'orientation:ntext',
                            'shape:ntext',
                            'context:ntext',
                            'architecture:ntext',
                            'style:ntext',                                                      
                            'adjacent:ntext',
                            'ventilation:ntext',
                            'lights:ntext',  
                            'environment:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Konstrukcija objekta
                        <div class="action-area normal-case"><?= Html::a('Uredi konstrukciju objekta', Url::to(['/project-building-structure/update', 'id'=>$model->project_id]), ['class' => 'btn btn-info btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista konstruktivnih delova predmetnog objekta.</div>
                </div>
                <div class="secondary-context">
                    <?= DetailView::widget([
                        'model' => $model->project->projectBuildingStructure,
                        'attributes' => [
                            'construction:ntext',
                            'foundation:ntext',
                            'wall_external:ntext',
                            'wall_internal:ntext',
                            'slab:ntext',
                            'columns:ntext',
                            'beam:ntext',
                            'roof:ntext',                            
                            'stair:ntext',
                            'truss:ntext',
                            'arch:ntext',                            
                            'chimney:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Materijalizacija objekta
                        <div class="action-area normal-case"><?= Html::a('Uredi materijale objekta', Url::to(['/project-building-materials/update', 'id'=>$model->project_id]), ['class' => 'btn btn-info btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista predviđenih materijala predmetnog objekta.</div>
                </div>
                <div class="secondary-context">
                    <?= DetailView::widget([
                        'model' => $model->project->projectBuildingMaterials,
                        'attributes' => [
                            'access:ntext',                            
                            'facade:ntext',
                            'roofing:ntext',                            
                            'door:ntext',
                            'window:ntext',  
                            'woodwork:ntext',
                            'steelwork:ntext',  
                            'tinwork:ntext',  
                            'wall_internal:ntext',
                            'flooring:ntext',
                            'ceiling:ntext',                        
                            'furniture:ntext',
                            'kitchen:ntext',
                            'sanitary:ntext',                            
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Izolacije objekta
                        <div class="action-area normal-case"><?= Html::a('Uredi izolacije objekta', Url::to(['/project-building-insulations/update', 'id'=>$model->project_id]), ['class' => 'btn btn-info btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista predviđenih izolacija predmetnog objekta.</div>
                </div>
                <div class="secondary-context">
                    <?= DetailView::widget([
                        'model' => $model->project->projectBuildingInsulations,
                        'attributes' => [
                            'thermal:ntext',
                            'sound:ntext',
                            'hidro:ntext',
                            'fireproof:ntext',
                            'chemical:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Instalacije objekta
                        <div class="action-area normal-case"><?= Html::a('Uredi instalacije objekta', Url::to(['/project-building-services/update', 'id'=>$model->project_id]), ['class' => 'btn btn-info btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista instalacija predmetnog objekta.</div>
                </div>
                <div class="secondary-context">
                    <?= DetailView::widget([
                        'model' => $model->project->projectBuildingServices,
                        'attributes' => [
                            'water:ntext',
                            'sewage:ntext',
                            'electricity:ntext',
                            'phone:ntext',
                            'tv:ntext',
                            'catv:ntext',
                            'internet:ntext',
                            'heating:ntext',                            
                            'gas:ntext',
                            'geotech:ntext',
                            'ac:ntext',
                            'ventilation:ntext',
                            'sprinkler:ntext',
                            'fire:ntext',
                            'lift:ntext',
                            'pool:ntext',                            
                            'traffic:ntext',                            
                            'special:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
