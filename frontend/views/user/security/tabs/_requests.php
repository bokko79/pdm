
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
        <div class="head colos thin">Moji zahtevi
        <div class="action-area normal-case"><?= (\Yii::$app->user->can('client')) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Novi zahtev'), ['/requests/create'], ['class' => 'btn btn-primary btn-lg shadow']) : null ?>
                  </div>
        </div>
        <div class="subhead">Zahtevi koje sam poslao projektatntima.</div>
        
    </div>
    
    <div class="secondary-context">
       <?= GridView::widget([
                'dataProvider' => $requests,
                'columns' => [
                    [
                        'attribute'=>'work',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a(\yii\helpers\StringHelper::truncate(c($data->fullname), 50), ['/requests/view', 'id' => $data->id]);
                        },
                    ],
                    
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->location->fullAddress, ['/requests/view', 'id' => $data->id]);
                        },
                    ],
                    [
                        'label'=>'Vreme zahteva',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            $formatter = \Yii::$app->formatter;
                            $formatter->locale = 'sr-Latn';
                            return $formatter->asDate($data->time, 'php:n mm Y, H:i');
                        },
                    ],
                    /*[
                        'label'=>'Projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->practice->name, ['practices/view', 'id' => $data->practice_id]);
                        },
                    ],*/
                    /*[
                        'label'=>'Investitor',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->client->name, ['clients/view', 'id' => $data->client_id]);
                        },
                    ],*/
                ],
            ]); ?>    

    </div>
</div>