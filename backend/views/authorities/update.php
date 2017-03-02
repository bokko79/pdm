<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Authorities */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Authorities',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="authorities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
