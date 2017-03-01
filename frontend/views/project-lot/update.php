<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Lot',
]) . $model->project_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_id, 'url' => ['view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-lot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
