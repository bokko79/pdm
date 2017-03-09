
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
        <div class="head">Stolarija i bravarija objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj poziciju', Url::to(['/project-building-doorwin/create', 'ProjectBuildingDoorwin[project_id]'=>$model->project_id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
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