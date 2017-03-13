
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
        <div class="head">Izolacije objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi izolacije objekta', Url::to(['/project-building/update', 'id'=>$model->id, '#'=>'w1-tab14']), ['class' => 'btn btn-success btn-succes']) ?></div>
        </div>
        <div class="subhead">Lista predviđenih izolacija predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingInsulations,
            'attributes' => [
                'thermal:ntext',
                'sound:ntext',
                'hidro:ntext',
                'fireproof:ntext',
                'chemical:ntext',
            ],
        ]) ?>
    </div>
</div>