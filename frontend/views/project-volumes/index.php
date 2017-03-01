<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectVolumesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Delovi projekta');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-volumes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Project Volumes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
               'attribute'=>'volume_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->volume->name, ['view', 'id'=>$data->id]);
                },
            ],
            [
               'attribute'=>'project_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->project->name, ['/projects/view', 'id'=>$data->project_id]);
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
            
            // 'number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
