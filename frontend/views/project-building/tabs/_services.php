
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
        <div class="head">Instalacije objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab15']), ['class' => 'btn btn-link']) ?></div>
        </div>
        <div class="subhead">Lista instalacija predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <div class="row">
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Postojeće stanje</h5>
                <?= DetailView::widget([
                    'model' => $model->projectBuildingServices,
                    'attributes' => [
                        'general_service:ntext',
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
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
            </div>
            <div class="col-sm-12">
                <h5 style="margin-bottom: 20px;">Predviđeno stanje</h5>
                <?= DetailView::widget([
                    'model' => $model_new->projectBuildingServices,
                    'attributes' => [
                        'general_service:ntext',
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
                    'options' => ['class'=>'table table-hover'],
                ]) ?>
            </div>
        </div>
    </div>
</div>


<?php else: ?>

<div class="card_container record-full grid-item fadeInUp no-shadow" id="">
    <div class="primary-context gray normal">
        <div class="head">Instalacije objekta
            <div class="subaction"><?= Html::a('<i class="fa fa-pencil fa-2x"></i>', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab15']), ['class' => 'btn btn-link']) ?></div>
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
            'options' => ['class'=>'table table-hover'],
        ]) ?>
    </div>
</div>

<?php endif; ?>