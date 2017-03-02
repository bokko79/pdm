<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Volumes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Volumes',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Volumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="volumes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>