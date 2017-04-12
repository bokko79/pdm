
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
        <div class="head">Instalacije objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi instalacije objekta', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab15']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista instalacija predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-6">
                <h4>Postojeće stanje</h4>
                <?= DetailView::widget([
                    'model' => $model->projectBuildingServices,
                    'attributes' => [
                        'water:ntext',
                        'sewage:ntext',
                        'electricity:ntext',
                        'phone:ntext',
                        'tv:ntext',
                        'catv:ntext',
                        'internet:ntext',
                        'heating:ntext',                            
                        'gas:ntext',
                        'geotech:ntext',
                        'ac:ntext',
                        'ventilation:ntext',
                        'sprinkler:ntext',
                        'fire:ntext',
                        'lift:ntext',
                        'pool:ntext',                            
                        'traffic:ntext',                            
                        'special:ntext',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-6">
                <h4>Predviđeno stanje</h4>
                <?= DetailView::widget([
                    'model' => $model_new->projectBuildingServices,
                    'attributes' => [
                        'water:ntext',
                        'sewage:ntext',
                        'electricity:ntext',
                        'phone:ntext',
                        'tv:ntext',
                        'catv:ntext',
                        'internet:ntext',
                        'heating:ntext',                            
                        'gas:ntext',
                        'geotech:ntext',
                        'ac:ntext',
                        'ventilation:ntext',
                        'sprinkler:ntext',
                        'fire:ntext',
                        'lift:ntext',
                        'pool:ntext',                            
                        'traffic:ntext',                            
                        'special:ntext',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>


<?php else: ?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Instalacije objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi instalacije objekta', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab15']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista instalacija predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingServices,
            'attributes' => [
                'water:ntext',
                'sewage:ntext',
                'electricity:ntext',
                'phone:ntext',
                'tv:ntext',
                'catv:ntext',
                'internet:ntext',
                'heating:ntext',                            
                'gas:ntext',
                'geotech:ntext',
                'ac:ntext',
                'ventilation:ntext',
                'sprinkler:ntext',
                'fire:ntext',
                'lift:ntext',
                'pool:ntext',                            
                'traffic:ntext',                            
                'special:ntext',
            ],
        ]) ?>
    </div>
</div>

<?php endif; ?>