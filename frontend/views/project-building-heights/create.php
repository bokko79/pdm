<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingHeights */

$this->title = Yii::t('app', 'Dodavanje visinu dela objekta');
$this->params['breadcrumbs'][] = ['label' => $model->projectBuilding->project->name, 'url' => ['/project-building/view', 'id' => $model->project_building_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-heights-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
