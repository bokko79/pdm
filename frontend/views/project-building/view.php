<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = $model->project->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projects/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'project.name',
                    'building.fullname',
                    'name',
                    'type',
                    'buildingType.name',
                    'ground_floor_level',
                    'building_line_dist',                    
                    'gross_area_part',
                    'gross_area',
                    'gross_area_above',
                    'gross_area_below',
                    'gross_built_area',
                    'net_area',
                    'ground_floor_area',
                    'occupancy_area',
                    'storey',
                    'storey_height',
                    'units_total',
                    'ridge_orientation',
                    'roof_pitch',
                    'characteristics:ntext',
                    'cost',
                ],
            ]) ?>
        </div>
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Spratovi objekta
                        <div class="action-area normal-case"><?= Html::a('Generiši spratove', Url::to(['/project-building/generate-storeys', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingStoreys,
                        'columns' => [
                            [
                                'label'=>'ID',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->id, ['project-building-storeys/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Building',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->storey, ['project-building-storeys/view', 'id' => $data->id]);
                                },
                            ],
                        ],
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
                                'label'=>'ID',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->id, ['project-building-classes/update', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Building',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->building->name, ['project-building-classes/update', 'id' => $data->id]);
                                },
                            ],
                            'percent',
                            'area',
                        ],
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
                        ],
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
                            'shape:ntext',
                            'architecture:ntext',
                            'style:ntext',
                            'context:ntext',
                            'ventilation:ntext',
                            'lights:ntext',
                            'orientation:ntext',
                            'adjacent:ntext',
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
                            'wall_bearing:ntext',
                            'wall_internal:ntext',
                            'slab:ntext',
                            'columns:ntext',
                            'beam:ntext',
                            'truss:ntext',
                            'stair:ntext',
                            'arch:ntext',
                            'door:ntext',
                            'window:ntext',
                            'roof:ntext',
                            'chimney:ntext',
                            'facade:ntext',
                            'tinwork:ntext',
                            'woodwork:ntext',
                            'steelwork:ntext',
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
                            'heating:ntext',
                            'ac:ntext',
                            'ventilation:ntext',
                            'gas:ntext',
                            'sprinkler:ntext',
                            'water:ntext',
                            'sewage:ntext',
                            'phone:ntext',
                            'tv:ntext',
                            'electricity:ntext',
                            'catv:ntext',
                            'internet:ntext',
                            'lift:ntext',
                            'pool:ntext',
                            'geotech:ntext',
                            'traffic:ntext',
                            'construction:ntext',
                            'fire:ntext',
                            'special:ntext',
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
                            'foundation:ntext',
                            'wall_external:ntext',
                            'wall_bearing:ntext',
                            'wall_internal:ntext',
                            'facade:ntext',
                            'flooring:ntext',
                            'ceiling:ntext',
                            'door:ntext',
                            'window:ntext',
                            'tinwork:ntext',
                            'stair:ntext',
                            'woodwork:ntext',
                            'steelwork:ntext',
                            'roof:ntext',
                            'light:ntext',
                            'sanitary:ntext',
                            'electrical:ntext',
                            'plumbing:ntext',
                            'hvac:ntext',
                            'chimney:ntext',
                            'furniture:ntext',
                            'kitchen:ntext',
                            'bathroom:ntext',
                            'lift:ntext',
                            'roofing:ntext',
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
</div>
