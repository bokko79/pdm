<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectClients */

$this->title = Yii::t('app', 'Izmeni/ukloni {modelClass}: ', [
    'modelClass' => 'investitora',
]) . $model->client->name;
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

