
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
        <div class="head">Konstrukcija objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab6']), ['class' => 'btn btn-link']) ?></div>
        </div>
        <div class="subhead">Lista konstruktivnih delova predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Postojeće stanje</h5>
                <?= DetailView::widget([
                    'model' => $model->projectBuildingStructure,
                    'attributes' => [
                        'construction:ntext',
                        'foundation:ntext',
                        'wall_external:ntext',
                        'wall_internal:ntext',
                        'slab:ntext',
                        'columns:ntext',
                        'beam:ntext',
                        'roof:ntext',                            
                        'stair:ntext',
                        'truss:ntext',
                        'arch:ntext',                            
                        'chimney:ntext',
                    ],
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
            </div>
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Predviđeno stanje</h5>
                <?= DetailView::widget([
                    'model' => $model_new->projectBuildingStructure,
                    'attributes' => [
                        'construction:ntext',
                        'foundation:ntext',
                        'wall_external:ntext',
                        'wall_internal:ntext',
                        'slab:ntext',
                        'columns:ntext',
                        'beam:ntext',
                        'roof:ntext',                            
                        'stair:ntext',
                        'truss:ntext',
                        'arch:ntext',                            
                        'chimney:ntext',
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
        <div class="head">Konstrukcija objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab6']), ['class' => 'btn btn-link']) ?></div>
        </div>
        <div class="subhead">Lista konstruktivnih delova predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingStructure,
            'attributes' => [
                'construction:ntext',
                'foundation:ntext',
                'wall_external:ntext',
                'wall_internal:ntext',
                'slab:ntext',
                'columns:ntext',
                'beam:ntext',
                'roof:ntext',                            
                'stair:ntext',
                'truss:ntext',
                'arch:ntext',                            
                'chimney:ntext',
            ],
            'options' => ['class'=>'table table-hover'],
        ]) ?>
    </div>
</div>

<?php endif; ?>