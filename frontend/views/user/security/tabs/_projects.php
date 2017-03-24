
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
        <div class="head colos thin">Moji projekti
        <div class="action-area normal-case"><?= (\Yii::$app->user->can('engineer')) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Kreiraj novi projekat'), ['/projects/create'], ['class' => 'btn btn-primary btn-lg shadow']) : null ?>
                  </div>
        </div>
        <div class="subhead">Projekti na kojima učestvujem kao glavni projektant, <br>odgovorni projektant, vršilac tehničke kontrole, saradnik projektanta, <br>vršilac stručnog nadzora, odgovorni izvođač.</div>
        
    </div>
    
    <div class="secondary-context">
       <?= GridView::widget([
                'dataProvider' => $projects,
                'columns' => [
                	'code',
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
                            return Html::a($data->location->city->town, ['/projects/view', 'id' => $data->id]);
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