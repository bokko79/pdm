<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'parcele projekta',
]) . $model->project->code;
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-lot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
