
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
        <div class="head">Konstrukcija objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi konstrukciju objekta', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab6']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista konstruktivnih delova predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-6">
                <h4>Postojeće stanje</h4>
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
                ]) ?>
            </div>
            <div class="col-sm-6">
                <h4>Predviđeno stanje</h4>
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
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Konstrukcija objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi konstrukciju objekta', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab6']), ['class' => 'btn btn-success btn-sm']) ?></div>
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
        ]) ?>
    </div>
</div>

<?php endif; ?>