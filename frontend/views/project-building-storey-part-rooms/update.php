<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyPartRooms */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'prostorije jedinice',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->projectBuildingStoreyPart->projectBuildingStorey->name, 'url' => ['/project-building/storeys', 'id' => $model->project_building_storey_part_id]];
$this->params['breadcrumbs'][] = ['label' => $model->projectBuildingStoreyPart->mark, 'url' => ['/project-building-storey-parts/view', 'id' => $model->project_building_storey_part_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-building-storey-part-rooms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
