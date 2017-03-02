<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotExistingBuildings */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'postojećeg objekta na parceli',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->project->code.': Parcela', 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

