
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<?= $model->file ? Html::img('/images/projects/'.date('Y').'/'.$model->project_id.'/'.$model->file->name, ['style'=>'max-height:100%;']) : null ?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Etaže objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cogs"></i> Upravljanje etažama', Url::to(['/project-building-storeys/index', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Bruto: <?= $model->grossArea ?> m<sup>2</sup>. Netto: <?= $model->netArea ?> m<sup>2</sup>. Redukovana netto: <?= $model->subNetArea ?> m<sup>2</sup></div>
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