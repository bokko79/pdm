<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = c($model->name) . ' projekta ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delovi projekta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-volumes-view">

    <h1><?= Html::encode($this->title).Html::a($model->project->code, ['/projects/view', 'id' => $model->project_id], []) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
               'attribute'=>'project_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->project->name, ['/projects/view', 'id'=>$data->project_id]);
                },
            ],
             'volume_id',
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
            [
               'attribute'=>'control_practice_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]);
                },
            ],
            [
               'attribute'=>'control_engineer_id',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]);
                },
            ],
            'number',
            'name',
            'code',
        ],
    ]) ?>

</div>
