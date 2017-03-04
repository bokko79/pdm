<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lista projekata');
$this->params['breadcrumbs'][] = $this->title;
?>    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Kreiraj novi projekat'), ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="subhead">Lista Vaših projekata.</div>
    </div>              
</div>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            [
               'attribute'=>'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/projects/view', 'id'=>$data->id]);
                },
            ],
            [
               'attribute'=>'client_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->client->name, ['/clients/view', 'id'=>$data->client_id]);
                },
            ],
            /*[
               'attribute'=>'building_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->building->class;
                },
            ],*/
            //'building.category',
            [
               'attribute'=>'location_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->location->city->town;
                },
            ],
            // 'location_id',
            //'work',
           /* [
               'attribute'=>'phase',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->projectPhase;
                },
            ],*/
            /*[
               'attribute'=>'work',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->projectTypeOfWorks;
                },
            ],*/
            [
               'attribute'=>'practice_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                },
            ],
            /*[
               'attribute'=>'engineer_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                },
            ],*/
            // 'location_access_id',
            // 'location_services_id',
            // 'city',
            // 'status',
            // 'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>