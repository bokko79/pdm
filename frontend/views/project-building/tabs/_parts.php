
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>


<?php else: ?>
    
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head">Delovi i celine objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj deo objekta', Url::to(['/project-building-parts/create', 'ProjectBuildingParts[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>
        
    </div>
    <div class="secondary-context">
        <?= GridView::widget([
            'dataProvider' => $projectBuildingParts,
            'columns' => [
                
                [
                    'attribute'=>'name',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return Html::a($data->name, ['project-building-parts/update', 'id' => $data->id]);
                    },
                ],
                'gross_area',
                'net_area',
                'storeys',
            ],
            'summary' => false,
        ]); ?>
    </div>
</div>

<?php endif; ?>