
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
        <div class="head">Arhitektonske karakteristike objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi karakteristike objekta', Url::to(['/project-building-characteristics/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista arhitektonskih karakteristika predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->project->projectBuildingCharacteristics,
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
        ]) ?>
    </div>
</div>