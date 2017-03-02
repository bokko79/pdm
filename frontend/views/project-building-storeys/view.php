<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreys */

$this->title = $model->name. ' - ' . $model->storey;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaže objekta'), 'url' => ['/project-building/storeys', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storeys-view">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci etaže
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi etažu', Url::to(['/project-building-storeys/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?> <?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
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
                            'project.name',
                            'storey',
                            'order_no',
                            'sub_net_area',
                            'net_area',
                            'gross_area',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
        
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Jedinice etaže
                        <div class="action-area normal-case"><?= Html::a('Upravljanje jedinicama etaže', Url::to(['/project-building-storeys/parts', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Ukupna neto površina etaže: <?= $model->netArea ?> m<sup>2</sup>. Ukupna redukovana neto površina etaže: <?= $model->subNetArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingStoreyParts,
                        'columns' => [
                            [
                                'label'=>'Jedinica',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->type, ['project-building-storey-parts/view', 'id' => $data->id]);
                                },
                            ],
                            'mark',
                            'structure',
                            [
                                'label'=>'Površina',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->netArea, ['project-building-storey-parts/view', 'id' => $data->id]);
                                },
                            ],
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div> 
        </div>
    </div>   

</div>
