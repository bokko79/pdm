<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dokumenti projekata');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-files-index">

    <h1><i class="fa fa-file"></i> <?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
               'attribute'=>'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/project-files/view', 'id'=>$data->id]);
                },
            ],
            [
               'attribute'=>'project_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->project->name, ['/projects/view', 'id'=>$data->project_id]);
                },
            ],
            'project.code',
            'number',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
