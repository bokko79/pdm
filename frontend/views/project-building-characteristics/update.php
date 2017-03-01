<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingCharacteristics */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'karakteristike objekta',
]) . $model->project_id;
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/project-building/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="project-building-characteristics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
