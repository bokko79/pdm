<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyDoorwin */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Building Storey Doorwin',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Storey Doorwins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-building-storey-doorwin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
