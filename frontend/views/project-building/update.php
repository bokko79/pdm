<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'predmetni objekat',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Predmetni objekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->building->class, 'url' => ['view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="project-building-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
