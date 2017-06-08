
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>
<div class="card_container record-full grid-item fadeInUp no-shadow" id="">
    <div class="primary-context gray normal">
        <div class="head">Arhitektura <?= $model->stateGen ?> objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab3']), ['class' => 'btn btn-link']) ?></div>
        </div>
        <div class="subhead">Lista arhitektonskih karakteristika <?= $model->stateGen ?> predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Postojeće stanje</h5>
                <?= DetailView::widget([
                    'model' => $model->projectBuildingCharacteristics,
                    'attributes' => [
                        'function:ntext',
                        'access:ntext',
                        'entrance:ntext',
                        'position:ntext',
                        'orientation:ntext',
                        'shape:ntext',
                        'context:ntext',
                        'architecture:ntext',
                        'style:ntext',                                                      
                        'adjacent:ntext',
                        'ventilation:ntext',
                        'lights:ntext',  
                        'environment:ntext',
                    ],
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
            </div>
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Predviđeno stanje</h5>
                <?= DetailView::widget([
                    'model' => $model_new->projectBuildingCharacteristics,
                    'attributes' => [
                        'function:ntext',
                        'access:ntext',
                        'entrance:ntext',
                        'position:ntext',
                        'orientation:ntext',
                        'shape:ntext',
                        'context:ntext',
                        'architecture:ntext',
                        'style:ntext',                                                      
                        'adjacent:ntext',
                        'ventilation:ntext',
                        'lights:ntext',  
                        'environment:ntext',
                    ],
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
            </div>
        </div>                
    </div>
</div>

<?php else: ?>

<div class="card_container record-full grid-item fadeInUp no-shadow" id="">
    <div class="primary-context gray normal">
        <div class="head">Arhitektura <?= $model->stateGen ?> objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab3']), ['class' => 'btn btn-link']) ?></div>
        </div>
        <div class="subhead">Lista arhitektonskih karakteristika <?= $model->stateGen ?> predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingCharacteristics,
            'attributes' => [
                'function:ntext',
                'access:ntext',
                'entrance:ntext',
                'position:ntext',
                'orientation:ntext',
                'shape:ntext',
                'context:ntext',
                'architecture:ntext',
                'style:ntext',                                                      
                'adjacent:ntext',
                'ventilation:ntext',
                'lights:ntext',  
                'environment:ntext',
            ],
            'options' => ['class'=>'table table-hover'],
        ]) ?>
    </div>
</div>

<?php endif; ?>