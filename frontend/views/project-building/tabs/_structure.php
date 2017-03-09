
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
        <div class="head">Konstrukcija objekta
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi konstrukciju objekta', Url::to(['/project-building-structure/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista konstruktivnih delova predmetnog objekta.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->project->projectBuildingStructure,
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