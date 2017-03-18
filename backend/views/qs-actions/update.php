<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QsActions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Qs Actions',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qs Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="qs-actions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
