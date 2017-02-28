<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectClients */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Clients',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
