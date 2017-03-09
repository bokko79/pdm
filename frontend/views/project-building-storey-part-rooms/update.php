<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyPartRooms */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'prostorije jedinice',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaže'), 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuildingStoreyPart->projectBuildingStorey->project_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaža'), 'url' => ['/project-building-storeys/view', 'id'=>$model->projectBuildingStoreyPart->project_building_storey_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Celine'), 'url' => ['/project-building-storey-parts/view', 'id'=>$model->project_building_storey_part_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

