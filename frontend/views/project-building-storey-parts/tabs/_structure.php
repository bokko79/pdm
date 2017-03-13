
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
        <div class="head">Konstrukcija jedinice
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi konstrukciju jedinice', Url::to(['/project-building-storey-parts/update', 'id'=>$model->id, '#'=>'w1-tab4']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista konstruktivnih delova predmetne jedinice.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingStoreyPartStructure,
            'attributes' => [                
                'wall_external:ntext',
                'wall_internal:ntext',
                'slab:ntext',
                'columns:ntext',
                'beam:ntext',                                        
                'stair:ntext',                
                'arch:ntext',                            
                'chimney:ntext',
            ],
        ]) ?>
    </div>
</div>