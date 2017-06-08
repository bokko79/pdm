<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingParts */

$this->title = 'Podešavanje sprata objekta';

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = 'Površine';

$this->params['building'] = $model->projectBuilding;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.$model->projectBuilding->name, 'url' => ['/project-building/view', 'id'=>$model->projectBuilding->id]];
$this->params['breadcrumbs'][] = ['label' => c($model->projectBuilding->name), 'url' => ['/project-building-storeys/view', 'id' => $model->projectBuilding->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->projectBuilding->project;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsParts' => $modelsParts,
        'modelsRooms' => $modelsRooms,
    ]) ?>

