<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'deo projekta',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delovi projekta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="project-volumes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
