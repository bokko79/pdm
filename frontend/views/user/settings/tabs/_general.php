
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<div class="card_container record-full grid-item fadeInUp animatedno" id="">
    <div class="primary-context normal">
        <div class="head third">Osnovni podaci</div>
        
    </div>
    
    <div class="secondary-context">
       <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'location.street',
                    'location.number',
                    'location.city.town',
                    'phone',
                    'email:email',
                    [
                       'attribute'=>'engineer_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                        },
                    ],
                    'fax',
                    'tax_no',
                    'company_no',
                    'account_no',
                    'bank',
                ],
                'options' => ['class'=>'table table-hover'],
            ]) ?>      

    </div>
</div>