<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BuildingTypes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Building Types',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Building Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="building-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
