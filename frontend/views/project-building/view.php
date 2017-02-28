<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = $model->project->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Buildings'), 'url' => ['index']];
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
                    'building_line_dist',
                    'lot_area',
                    'green_area_reg',
                    'green_area',
                    'gross_area_part',
                    'gross_area',
                    'gross_area_above',
                    'gross_area_below',
                    'gross_built_area',
                    'net_area',
                    'ground_floor_area',
                    'occupancy_area',
                    'occupancy_reg',
                    'occupancy',
                    'built_index_reg',
                    'built_index',
                    'storey',
                    'storey_height',
                    'units_total',
                    'parking_total',
                    'facade_material:ntext',
                    'ridge_orientation',
                    'roof_pitch',
                    'roof_material:ntext',
                    'characteristics:ntext',
                    'cost',
                ],
            ]) ?>
        </div>
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= ($model->building) ? Html::a('Spratovi', Url::to(['/project-building-storeys/index', 'ProjectBuildingStoreys[project_id]'=>$model->project_id]), []) : null ?></div>
                    <div class="subhead"><?= Html::a('Generiši spratove', Url::to(['/project-building/generate-storeys', 'id'=>$model->project_id]), ['class' => 'btn btn-warning btn-sm']) ?></div>
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
                    <div class="head"><?= ($model->building) ? Html::a('Klase', Url::to(['/project-building-classes/index', 'ProjectBuildingClasses[project_id]'=>$model->project_id]), []) : null ?></div>
                    <div class="subhead"><?= Html::a('Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_id]'=>$model->project_id]), ['class' => 'btn btn-warning btn-sm']) ?></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingClasses,
                        'columns' => [
                            [
                                'label'=>'ID',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->id, ['project-building-classes/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Building',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->file->name, ['project-building-classes/view', 'id' => $data->id]);
                                },
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= ($model->building) ? Html::a('Visine', Url::to(['/project-building-heights/index', 'ProjectBuildingHeights[project_building_id]'=>$model->project_id]), []) : null ?></div>
                    <div class="subhead"><?= Html::a('Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$model->project_id]), ['class' => 'btn btn-warning btn-sm']) ?></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingHeights,
                        'columns' => [
                            [
                                'label'=>'ID',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->id, ['project-building-heights/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Building',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->file->name, ['project-building-heights/view', 'id' => $data->id]);
                                },
                            ],
                            'type',
                            'value',
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
                    <div class="head"><?= ($model->building) ? Html::a('Karakteristike', Url::to(['/project-building-characteristics/index', 'ProjectBuildingCharacteristics[project_id]'=>$model->project_id]), []) : null ?></div>
                    <div class="subhead"><?= Html::a('Dodaj visinu dela objekta', Url::to(['/project-building-characteristics/create', 'ProjectBuildingCharacteristics[project_id]'=>$model->project_id]), ['class' => 'btn btn-warning btn-sm']) ?></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingCharacteristics,
                        'columns' => [
                            [
                                'label'=>'ID',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->id, ['project-building-characteristics/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Building',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->project->name, ['project-building-characteristics/view', 'id' => $data->id]);
                                },
                            ],
                            'type',
                            'value',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
