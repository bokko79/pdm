<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotFutureDevelopments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Lot Future Developments',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lot Future Developments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-lot-future-developments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
