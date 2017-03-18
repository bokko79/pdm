
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
        <div class="head">Projekti</div>
        <div class="subhead">Projekti na kojima je inženjer glavni projektant.</div>
        
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
                            return Html::a(\yii\helpers\StringHelper::truncate($data->name, 30), ['projects/view', 'id' => $data->id]);
                        },
                    ],
                    
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->location->city->town, ['projects/view', 'id' => $data->id]);
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