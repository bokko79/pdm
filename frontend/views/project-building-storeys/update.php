<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingParts */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'etaže objekta',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->storey, 'url' => ['/project-building-storeys/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

