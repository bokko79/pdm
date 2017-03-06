<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingDoorwin */

$this->title = Yii::t('app', 'Kreiranje pozicije stolarije/bravarije');
$this->params['breadcrumbs'][] = ['label' => 'Objekat', 'url' => ['/project-building/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-doorwin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>