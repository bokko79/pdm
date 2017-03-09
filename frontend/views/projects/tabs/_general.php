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
        <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci projekta
        
        </div>
        <div class="subhead">Predmetni projekat.</div>
    </div>
    <div class="secondary-context">   
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'code',
                [
                   'attribute'=>'client_id',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return Html::a($data->client->name, ['/clients/view', 'id'=>$data->client_id]);
                    },
                ],
                'building.name',
                'location.city.town',
                'projectTypeOfWorks',
                'projectPhase',
                [
                   'attribute'=>'practice_id',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                    },
                ],
                [
                   'attribute'=>'engineer_id',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                    },
                ],
                [
                   'attribute'=>'control_practice_id',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return $data->controlPractice ? Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]) : null;
                    },
                ],
                [
                   'attribute'=>'control_engineer_id',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return $data->controlEngineer ? Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]) : null;
                    },
                ],
                'status',
                [
                   'attribute'=>'time',
                   'format' => 'raw',
                   'value'=>function ($data) {
                        return Yii::$app->formatter->asDate($data->time, 'php:mm Y');
                    },
                ],
                
            ],
        ]) ?>
    </div>            
</div>