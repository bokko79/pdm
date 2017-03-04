<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyDoorwin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Storey Doorwins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storey-doorwin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'project_building_storey_id',
            'project_building_doorwin_id',
            'lefts',
            'rights',
            'total',
            'length',
            'length_horizontal',
            'length_slanted',
            'length_vertical',
        ],
    ]) ?>

</div>
