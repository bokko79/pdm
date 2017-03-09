
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
        <div class="head">Instalacije objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi instalacije objekta', Url::to(['/project-building-services/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista instalacija predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->project->projectBuildingServices,
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