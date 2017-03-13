
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
        <div class="head">Materijalizacija jedinice
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i> Uredi materijale jedinice', Url::to(['/project-building-storey-parts/update', 'id'=>$model->id, '#'=>'w1-tab7']), ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="subhead">Lista predviđenih materijala predmetne jedinice.</div>
    </div>
    <div class="secondary-context">
        <?= DetailView::widget([
            'model' => $model->projectBuildingStoreyPartMaterials,
            'attributes' => [
                'access:ntext',                            
                'facade:ntext',
                'roofing:ntext',                            
                'door:ntext',
                'window:ntext',  
                'woodwork:ntext',
                'steelwork:ntext',  
                'tinwork:ntext',  
                'wall_internal:ntext',
                'flooring:ntext',
                'ceiling:ntext',                        
                'furniture:ntext',
                'kitchen:ntext',
                'sanitary:ntext',                            
            ],
        ]) ?>
    </div>
</div>