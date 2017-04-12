
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
        <div class="head colos thin">
        <div class="action-area normal-case"><?= (\Yii::$app->user->can('engineer')) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Započni novi projekat'), ['/projects/create'], ['class' => 'btn btn-primary btn-lg shadow']) : null ?>
                  </div>
                  Moji projekti
        </div>
        <div class="subhead">Projekti na kojima učestvujem kao glavni projektant, <br>odgovorni projektant, vršilac tehničke kontrole, saradnik projektanta, <br>vršilac stručnog nadzora, odgovorni izvođač.</div>
        
    </div>
    
    <div class="secondary-context">
        <div class="table-responsive">            
        
            <?= GridView::widget([
                'dataProvider' => $projects,
                'columns' => [
                    [
                        'label'=>'Avatar projekta',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->avatar;
                        },
                    ],
                    [
                        'attribute'=>'code',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->code, ['/projects/view', 'id' => $data->id]);
                        },
                        'contentOptions' => ['style'=>'width:80px; min-height:100px; overflow: auto; word-wrap: break-word;'],
                    ],
                    [
                        'label'=>'Naziv projekta',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a(\yii\helpers\StringHelper::truncate($data->name, 30), ['/projects/view', 'id' => $data->id]);
                        },
                    ],
                    
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->location->fullAddress;
                        },
                        'contentOptions' => ['style'=>'max-width:250px; min-height:100px; overflow: auto; word-wrap: break-word;'],
                    ],
                    /*[
                        'label'=>'Projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->practice->name, ['practices/view', 'id' => $data->practice_id]);
                        },
                    ],*/
                    [
                        'label'=>'Investitor',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->client->name, ['/clients/view', 'id' => $data->client_id]);
                        },
                    ],
                ],
            ]); ?>    
        </div>
    </div>
</div>