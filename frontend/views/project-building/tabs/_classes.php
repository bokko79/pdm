
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
        <div class="head">Klase objekta                        
            
        </div>
        
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-6">
                <div class="head lower thin">                      
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    Postojeće stanje
                </div>
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
                    'options' => ['class'=>'responsive'],
                ]); ?>
                <?= ($model->getClassPercentageTotal()!=100) ? '<p class="red">Zbir procenata svih delova objekta mora biti jednak 100!. Trenutno je '.$model->getClassPercentageTotal().'</p>' : null ?>
            </div>
            <div class="col-sm-6">
                <div class="head lower thin">                
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$model_new->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    Predviđeno stanje      
                </div>
                <?= GridView::widget([
                    'dataProvider' => $projectBuildingClasses_new,
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
                    'options' => ['class'=>'responsive'],
                ]); ?>
                <?= ($model->getClassPercentageTotal()!=100) ? '<p class="red">Zbir procenata svih delova objekta mora biti jednak 100!. Trenutno je '.$model->getClassPercentageTotal().'</p>' : null ?>
            </div>
        </div>  
    </div>
</div>


<?php else: ?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">                     
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
            Klase objekta
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

<?php endif; ?>