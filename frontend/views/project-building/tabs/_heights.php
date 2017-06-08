
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Visine objekta
        </div>
        
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-6">
                <div class="head lower thin">                      
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    Postojeće stanje
                </div>
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
                    'options' => ['class'=>'responsive'],
                ]); ?>
                
            </div>
            <div class="col-sm-6">
                <div class="head lower thin">                     
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$model_new->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    Predviđeno stanje 
                </div>
                <?= GridView::widget([
                    'dataProvider' => $projectBuildingHeights_new,
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
                    'options' => ['class'=>'responsive'],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj visinu dela objekta', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
            Visine objekta
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

<?php endif; ?>