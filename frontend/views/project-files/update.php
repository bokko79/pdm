<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'projektnog dokumenta',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projekat: '.$model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
