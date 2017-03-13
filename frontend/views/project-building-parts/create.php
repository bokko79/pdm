<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingParts */

$this->title = Yii::t('app', 'Dodaj deo predmetnog objekta');
$this->params['breadcrumbs'][] = ['label' => $model->projectBuilding->project->name, 'url' => ['/project-building/view', 'id' => $model->project_building_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
