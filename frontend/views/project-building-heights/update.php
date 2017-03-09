<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingHeights */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'visina delova objekta',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visine delova objekta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-building-heights-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
