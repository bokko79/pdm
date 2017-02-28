<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocationLots */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'katastarsku parcelu',
]) . $model->lot;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Katastarske parcele'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="location-lots-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
