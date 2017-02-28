<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Spisak projekata');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><i class="fa fa-file"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Kreiraj novi projekat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            [
               'attribute'=>'phase',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->projectPhase;
                },
            ],
            [
               'attribute'=>'work',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->projectTypeOfWorks;
                },
            ],
            [
               'attribute'=>'practice_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                },
            ],
            [
               'attribute'=>'engineer_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                },
            ],
            // 'location_access_id',
            // 'location_services_id',
            // 'city',
            // 'status',
            // 'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>