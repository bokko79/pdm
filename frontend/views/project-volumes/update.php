<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'deo projekta',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->project->code. ': Projekat', 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="project-volumes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
