
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
        <div class="head">Visine objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_id]'=>$model->project_id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
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