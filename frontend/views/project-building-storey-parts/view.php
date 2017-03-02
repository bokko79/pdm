<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaža objekta'), 'url' => ['/project-building-storeys/view', 'id'=>$model->project_building_storey_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storey-parts-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci jedinice
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi jedinicu', Url::to(['/project-building-storey-parts/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?> <?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
                        </div>
                    </div>
                    <div class="subhead"></div>
                </div>
                <div class="secondary-context">  
                   <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'project_building_storey_id',
                            'type',
                            'name',
                            'mark',
                            'structure',
                            'area',
                            'description:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
        
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Prostorije jedinice etaže
                        <div class="action-area normal-case"><?= Html::a('Dodaj prostoriju', Url::to(['/project-building-storey-part-rooms/create', 'ProjectBuildingStoreyPartRooms[project_building_storey_part_id]'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Ukupna neto površina jedinice: <?= $model->netArea ?> m<sup>2</sup>. Ukupna redukovana neto površina jedinice: <?= $model->subNetArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingStoreyPartRooms,
                        'columns' => [
                            [
                                'label'=>'Prostorija',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->type, ['project-building-storey-parts/view', 'id' => $data->id]);
                                },
                            ],
                            'mark',
                            'name',
                            'circumference',
                            'flooring',
                            'length',
                            'width',
                            'height',
                            'sub_net_area',
                            'net_area',

                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div> 
        </div>
    </div>   

</div>
