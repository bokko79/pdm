
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
        <div class="head">Klase objekta                        
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj klasu objekta', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
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