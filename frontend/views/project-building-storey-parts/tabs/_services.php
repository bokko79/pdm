
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
        <div class="head">Instalacije jedinice
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi instalacije jedinice', Url::to(['/project-building-storey-parts/update', 'id'=>$model->id, '#'=>'w1-tab12']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista instalacija predmetne jedinice.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingStoreyPartServices,
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