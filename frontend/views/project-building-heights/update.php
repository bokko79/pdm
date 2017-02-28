<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingHeights */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Building Heights',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Heights'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-building-heights-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
