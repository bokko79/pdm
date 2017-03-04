<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingDoorwin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Doorwins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-doorwin-view">

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
            'pos_no',
            'pos_type',
            'type',
            'name',
            'project_id',
            'description:ntext',
            'width',
            'height',
            'frame',
            'sash',
            'opening_type',
            'material',
            'metal',
            'note',
            'scale',
            'file_id',
        ],
    ]) ?>

</div>
