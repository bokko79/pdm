<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'inženjera',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjeri'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="engineers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
