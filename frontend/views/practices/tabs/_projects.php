
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
        <div class="head button_to_show_secondary">Projekti

        </div>
        <div class="subhead">Projekti na kojima firma ima svojstvo projektanta.</div>
    </div>
    <div class="secondary-context">
        <?= GridView::widget([
            'dataProvider' => $projects,
            'columns' => [
                [
                    'attribute'=>'name',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return Html::a($data->name, ['projects/view', 'id' => $data->id]);
                    },
                ],
                'code',
                //'projectPhase',
                'projectTypeOfWorks',
                [
                    'attribute'=>'location_id',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->location->city->town;
                    },
                ],
                [
                    'attribute'=>'engineer_id',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return Html::a($data->engineer->name, ['engineers/view', 'id' => $data->engineer_id]);
                    },
                ],
                [
                    'attribute'=>'client_id',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return Html::a($data->client->name, ['clients/view', 'id' => $data->client_id]);
                    },
                ],
            ],
        ]); ?>
    </div>
</div> 