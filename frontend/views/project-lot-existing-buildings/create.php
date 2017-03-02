<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotExistingBuildings */

$this->title = Yii::t('app', 'Dodaj postojeći objekat na parceli');
$this->params['breadcrumbs'][] = ['label' => $model->project->code. ': Parcela', 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

