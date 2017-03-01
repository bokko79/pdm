<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotExistingBuildings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Lot Existing Buildings',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lot Existing Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-lot-existing-buildings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
