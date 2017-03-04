<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingDoorwin */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'pozicije stolarije/bravarije',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/project-building/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-building-doorwin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
