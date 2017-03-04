<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EngineerLicences */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'licencnog paketa inženjera',
]) . $model->engineer->name;
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/engineers/view', 'id' => $model->engineer_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

