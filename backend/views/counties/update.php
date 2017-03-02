<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Counties */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Counties',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Counties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="counties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
