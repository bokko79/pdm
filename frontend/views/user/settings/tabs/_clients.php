
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-building"></i> Investitori firme
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Novi investitor'), ['/clients/create'], ['class' => 'btn btn-primary btn-sm shadow' ]) ?>
            </div>
        </div>
        <div class="subhead">Lista registrovanih investitora.</div>
        
    </div>
    <div class="secondary-context">
        <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $clients,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                 'format' => 'raw',
                'value'=>function ($data) {
                        return Html::a($data->name, ['/clients/view', 'id'=>$data->id]);
                },
            ],
            'location.city.town',
            'phone',
            'email:email',
            // 'type',
            'contact_person',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?> 
    </div>
 </div>   
          
