<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumeInsets */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Phase Volume Insets',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phase Volume Insets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="phase-volume-insets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
