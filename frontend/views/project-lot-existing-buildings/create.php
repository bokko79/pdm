<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotExistingBuildings */

$this->title = Yii::t('app', 'Create Project Lot Existing Buildings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lot Existing Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-lot-existing-buildings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
