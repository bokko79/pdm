<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = $model->project_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-lot-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->project_id], [
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
            'project_id',
            'conditions',
            'width',
            'length',
            'disposition:ntext',
            'type',
            'area',
            'ground_level',
            'road_level',
            'underwater_level',
            'ground:ntext',
            'access:ntext',
            'ownership:ntext',
            'adjacent_border:ntext',
            'services:ntext',
            'description:ntext',
            'note:ntext',
            'legal:ntext',
            'green_area_reg',
            'green_area',
            'occupancy_reg',
            'built_index_reg',
            'parking:ntext',
            'parking_spaces',
            'parking_disabled',
        ],
    ]) ?>

</div>
