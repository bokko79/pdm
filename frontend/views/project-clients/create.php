<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStructure */

$this->title = Yii::t('app', 'Dodavanje investitora projekta');
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

